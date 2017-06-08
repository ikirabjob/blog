<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 08.06.2017
 * Time: 9:36
 */

// подключаем необходимые файлы
define('ROOT', dirname(__FILE__));
define('VIEWS_BASEDIR', dirname(__FILE__).'/app/views/');
$routes = ROOT.'/config/routes.php';

require(__DIR__ . '/vendor/autoload.php');

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);


require(__DIR__ . '/config/database.php');

// запускаем роутер
$router = new Core\Router($routes);

$router->add('', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('post/add', ['controller' => 'PostController', 'action' => 'add']);
$router->add('post/store', ['controller' => 'PostController', 'action' => 'store']);
$router->add('post/edit/{id:\d+}', ['controller' => 'PostController', 'action' => 'edit']);
$router->add('post/update', ['controller' => 'PostController', 'action' => 'update']);
$router->add('post/show/{id:\d+}', ['controller' => 'PostController', 'action' => 'show']);
$router->add('post/delete', ['controller' => 'PostController', 'action' => 'delete']);

$router->dispatch($_SERVER['QUERY_STRING']);