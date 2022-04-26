<?php

namespace ApertureCore\Http;

use Exception;

class Router
{
    private array $routes = [];

    public function __construct()
    {
    }

    public function registerRoute(string $str_request, array $action): self
    {
        $this->routes[] = new Route($str_request, $action);

        return $this;

    }

    /**
     * @throws InvalidRootData
     * @throws RouteNotFoundException
     */
    public function start(): void
    {
        $requested_route = null;
        $requested_url = $_SERVER['REDIRECT_URL'] ?? '/';
        $requested_method = strtolower($_SERVER['REQUEST_METHOD']);

        foreach ($this->routes as $route) {
            // Si l\'url ne correspond pas, on passe au tour suivant
            if ($route->url !== $requested_url) continue;

            if(!empty($route->method) && $route->method !== $requested_method) continue;

            $requested_route = $route;
            break; // On interrompt la boucle
        }

        if (is_null($requested_route)) throw new RouteNotFoundException($requested_url);

        $is_valid = true;
        if (count($requested_route->action) < 2) $is_valid = false;
        elseif (!class_exists($requested_route->action[0])) $is_valid = false;
        elseif (!method_exists($requested_route->action[0], $requested_route->action[1])) $is_valid = false;

        if ($is_valid === true) {
            $page_class = $requested_route->action[0];
            $page_instance = new $page_class;
        }

        try {

            call_user_func_array([ $page_instance , $requested_route->action[1]], []);

        } catch (\Throwable $e) {

            throw new InvalidRootData($requested_route->action, $e);

        }

    }
}