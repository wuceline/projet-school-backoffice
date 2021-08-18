<?php

namespace App\Controllers;

use App\Utils\Database;

class CoreController
{
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
}