<?php

namespace App\Controllers;


class PaysController {

    public function index(){
        echo 'Page Home';
    }

    public function show(int $id){
        echo 'Je suis le pays';
    }
}