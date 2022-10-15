<?php

namespace panda\controllers;
use panda\core\Controllers;
use panda\core\Application;
use panda\core\Request;

class BaseController extends Controllers{

    public function show(){
        $name['name'] = "Kartik";
        $this->setLayout('master');
        return $this->views("contact", $name);
    }

    public function store(Request $request){
        // echo "hlo done";
        $body = $request->getFilterData();
        print_r($body);
    }
}