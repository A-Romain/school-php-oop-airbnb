<?php

namespace ApertureCore;

class View
{

    public const PATH_VIEWS = PATH_ROOT . 'views' . DS;
    public const ERROR_LIST = [400, 401, 403, 404, 500, 503];
    public string $title = 'DEFAULT FRAMEWORK PAGE NAME';
    private string $name;
    private bool $is_complete;

    public function getName(): string
    {
        return $this->name;
    }

    public function __construct(string $name, $is_complete = false)
    {
        $this->name = $name;
        $this->is_complete = $is_complete;

    }

    public static function renderError(int $code): void
    {
        if (!in_array($code, self::ERROR_LIST)) $code = 500;
        http_response_code($code);
        $is_complete = $code !== 404;

        $view = new View('errors/' . $code, $is_complete);

        if ($code === 404) $view->title = 'Page inexistante - Mon super site MVC';

        $view->render();
    }



    public function render(array $view_data = []): void
    {

        $title_tag = $this->title;

        extract($view_data);

        ob_start();

        if (!$this->is_complete) {
            require_once self::PATH_VIEWS . '_partials' . DS . '_top.html.php';
        }

        require_once $this->getRequirePath();

        if (!$this->is_complete) {
            require_once self::PATH_VIEWS . '_partials' . DS . '_bottom.html.php';
        }

        ob_end_flush();
    }



    public function getRequirePath() : string
    {
        $arr_name = explode('/', $this->name);

        $category = $arr_name[0];
        $page_name = $arr_name[1];
        $name_prefix = $this->is_complete ? '' : '_';

        return self::PATH_VIEWS . $category . DS .$name_prefix .  $page_name .'.html.php'  ;

    }

}