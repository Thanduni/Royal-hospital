<?php

class Controller{

    function __construct() {
        $this->view = new Views();
    }

    //when giving names for Model files always use 'Model' as suffix
    //create the object and required
    public function loadModel($modelName) {
        $path = '../Application/Model/' . $modelName . 'Model.php';
        if (file_exists($path)) {
            require $path;
            $className = $modelName . 'Model';
            $this->model = new $className();
        }
    }

    public function redirect($path){
        header("location:" . BASEURL . "/".$path);
    }
}