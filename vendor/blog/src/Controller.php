<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 08.06.2017
 * Time: 12:31
 */

namespace Core;

use Core\View;

class Controller
{

    protected $params = [];

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function view($page, $params = []){
        $view = new View();
        return $view->render($page, $params);
    }

    public function redirect($route){
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: {$route}");
    }
}