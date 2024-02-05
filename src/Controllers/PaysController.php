<?php

namespace App\Controllers;
use App\Models\Pays;
use Database\DBConnection;

class PaysController extends Controller {

    public function welcome()
    {
        return $this->view('Pays.welcome');
    }

    public function index()
    {
        $pays = new Pays($this->getDB());
        $pays = $pays->all();

        return $this->view('Pays.index', compact('pays'));
    }

    public function show(int $id)
    {
        $pay = new Pays ($this->getDB());
        $pays = $pay->findById($id);      
        
        return $this->view('Pays.show' , compact('pays'));
    }
}