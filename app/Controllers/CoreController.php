<?php

namespace App\Controllers;


class CoreController
{

    public function __construct()
    {
        global $match;

        if (is_bool($match)){
            return;
        }
        $routeName = $match['name'];

        $acl=[
            'main-home'             => ['admin', 'user'],
            'teacher-list'          => ['admin', 'user'],
            'teacher-create'        => ['admin'],
            'teacher-create-post'   => ['admin'],
            'teacher-update'        => ['admin'],
            'teacher-update-post'   => ['admin'],
            'student-list'          => ['admin', 'user'],
            'student-create'        => ['admin', 'user'],
            'student-create-post'   => ['admin', 'user'],
        ];

        if (array_key_exists($routeName, $acl)) {
            $authorizedRoles = $acl[$routeName];
            $this->checkAuthorization($authorizedRoles);
        }

    }

    protected function show($viewName, $viewData=[])
    {
        global $router;
        $viewData['currentPage'] = $viewName; 
        $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        $viewData['baseUri'] = $_SERVER['BASE_URI'];

        extract($viewData);

        require_once __DIR__.'/../views/layout/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/layout/footer.tpl.php';

    }

    public function checkAuthorization($roles=[])
    {
        if (isset($_SESSION['userId'])){
            $appUser = $_SESSION['userObject'];
            $roleUser = $appUser->getRole();

            if(in_array($roleUser,$roles)){

                return true;
            }else{
                http_response_code(403);
                $this->show('error/err403');
                exit;
            }

        }else{
            global $router;
            header('Location:'. $router->generate('signin'));
        }
    }
}