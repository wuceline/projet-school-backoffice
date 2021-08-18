<?php 
require_once '../vendor/autoload.php';


$router = new AltoRouter();

if (array_key_exists('BASE_URI', $_SERVER)) {
    $router->setBasePath($_SERVER['BASE_URI']);
}
else {
    $_SERVER['BASE_URI'] = '/';
};

$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-home'
);
$router->map(
    'GET',
    '/teachers',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\TeacherController'
    ],
    'teacher-list'
);

$match = $router->match();

$dispatcher = new Dispatcher($match,'\App\Controllers\ErrorController::err4');

$dispatcher->dispatch();