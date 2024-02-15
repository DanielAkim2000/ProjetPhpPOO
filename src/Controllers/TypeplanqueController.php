<?php

namespace App\Controllers;
use App\Models\Typeplanque;

class TypeplanqueController extends Controller {

    public function index()
    {
        $this->isAdmin();

        $typeplanques =  new Typeplanque($this->getDB());
        $typeplanques = $typeplanques->all();

        return $this->view('Typeplanques.index', compact('typeplanques'));
    }

    public function create()
    {
        $this->isAdmin();

        return $this->view('Typeplanques.form');
    }

    public function created()
    {
        $this->isAdmin();

        $typeplanques =  new Typeplanque($this->getDB());
        $result = $typeplanques->create($_POST);

        if($result){
            return header('Location: /ECF/Typeplanques');
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $typeplanque = new Typeplanque($this->getDB());
        $typeplanque = $typeplanque->findById($id);

        return $this->view('Typeplanques.form', compact('typeplanque'));
    }

    public function update(int $id)
    {
        $this->isAdmin();

        $typeplanque =  new Typeplanque($this->getDB());
        $result = $typeplanque->update($id,$_POST);

        if($result){
            return header('Location: /ECF/Typeplanques');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();

        $typeplanque = new Typeplanque($this->getDB());
        $result = $typeplanque->destroy($id);

        if($result){
            return header('Location: /ECF/Typeplanques');
        }
    }
}