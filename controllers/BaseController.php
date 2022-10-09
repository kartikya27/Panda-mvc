<?php

namespace panda\controllers;
use panda\core\Controllers;
use panda\core\Application;

class BaseController extends Controllers{

    public function show(){
        $name['name'] = "Kartik";
        return $this->views("contact", $name);
    }

    public function store(){
        echo "hlo done";
    }
}