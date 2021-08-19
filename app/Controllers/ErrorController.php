<?php

namespace App\Controllers;

class ErrorController extends CoreController {

    public function err404() {
        header('HTTP/1.0 404 Not Found');

        $this->show('error/err404');
    }
    
    public function err403() {
        header('HTTP/1.0 403 Not Found');

        $this->show('error/err403');
    }

}