<?php

namespace ApertureCore\Http;

use Throwable;

class InvalidRootData extends \Exception
{
    private array $route_action;

    /**
     * @return array
     */
    public function getRouteAction(): array
    {
        return $this->route_action;
    }

    public function __construct(array $route_action, Throwable $previous = null)
    {
        parent::__construct('Invalid route data',400, $previous);

        $this->route_action = $route_action;

    }
}