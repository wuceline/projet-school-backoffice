<?php 
require_once '../vendor/autoload.php';

session_start();

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

// TEACHER
$router->map(
    'GET',
    '/teachers',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\TeacherController'
    ],
    'teacher-list'
);
$router->map(
    'GET',
    '/teacher/add',
    [
        'method' => 'create',
        'controller' => '\App\Controllers\TeacherController'
    ],
    'teacher-create'
);
$router->map(
    'POST',
    '/teacher/add',
    [
        'method' => 'createPost',
        'controller' => '\App\Controllers\TeacherController'
    ],
    'teacher-create-post',
);
$router->map(
    'GET',
    '/teacher/update/[i:idTeacher]',
    [
        'method'=>'update',
        'controller'=>'\App\Controllers\TeacherController'
    ],
    'teacher-update'
);
$router->map(
    'POST',
    '/teacher/update/[i:idTeacher]',
    [
        'method'=>'updatePost',
        'controller'=>'\App\Controllers\TeacherController'
    ],
    'teacher-update-post'
);


// STUDENT
$router->map(
    'GET',
    '/students',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\StudentController'
    ],
    'student-list'
);
$router->map(
    'GET',
    '/student/add',
    [
        'method' => 'create',
        'controller' => '\App\Controllers\StudentController'
    ],
    'student-create'
);
$router->map(
    'POST',
    '/student/add',
    [
        'method' => 'createPost',
        'controller' => '\App\Controllers\StudentController'
    ],
    'student-create-post'
);
$router->map(
    'GET',
    '/student/update/[i:idStudent]',
    [
        'method'=>'update',
        'controller'=>'\App\Controllers\StudentController'
    ],
    'student-update'
);
$router->map(
    'POST',
    '/student/update/[i:idStudent]',
    [
        'method'=>'updatePost',
        'controller'=>'\App\Controllers\StudentController'
    ],
    'student-update-post'
);

// LOGIN/LOGOUT
$router->map(
    'GET',
    '/signin',
    [
        'method' => 'signin',
        'controller' => '\App\Controllers\SecurityController'
    ],
    'signin'
);
$router->map(
    'POST',
    '/signin',
    [
        'method' => 'signinPost',
        'controller' => '\App\Controllers\SecurityController'
    ],
    'signin-post'
);
$router->map(
    'GET',
    '/signout',
    [
        'method'=>"signout",
        'controller'=>'\App\Controllers\SecurityController'
    ],
    'signout'
);

$match = $router->match();

$dispatcher = new Dispatcher($match,'\App\Controllers\ErrorController::err404');

$dispatcher->dispatch();