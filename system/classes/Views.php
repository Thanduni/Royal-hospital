<?php

class Views {

    function __construct() {
    }

    public function render($viewName, $data = []) {
        require '../Application/Views/' . $viewName . '.php';
    }
}