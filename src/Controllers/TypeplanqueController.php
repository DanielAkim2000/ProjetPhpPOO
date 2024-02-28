<?php

namespace App\Controllers;
use App\Models\Typeplanque;
use App\Validation\Validator;

class TypeplanqueController extends Controller {

    public function index(int $page)
    {
        $this->isAdmin();

        $typeplanques =  new Typeplanque($this->getDB());
        $dataarray = $typeplanques->getElementsForPage($page);
        //Dans $dataarray[0] on recupere le nombre de page
        $nbPage = $dataarray[0];
        //Et ici on recupere les données a afficher
        $typeplanques = $dataarray[1];

        return $this->view('Typeplanques.index', compact('typeplanques', 'nbPage' ,'page'));
    }

    public function create()
    {
        $this->isAdmin();

        return $this->view('Typeplanques.form');
    }

    public function created()
    {
        $this->isAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate(
            [
                'description' => ['required','max:30','min:1','notinjection'],
            ]
        );
        if($errors){
            $_SESSION['errors'] = $errors;
            return header('Location: /ECF/Typeplanques/Create');
        }

        $typeplanques =  new Typeplanque($this->getDB());
        $result = $typeplanques->create($_POST);

        if($result){
            return header('Location: /ECF/Typeplanques/1');
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
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate(
            [
                'description' => ['required','max:30','min:1','notinjection'],
            ]
        );
        if($errors){
            $_SESSION['errors'] = $errors;
            return header('Location: /ECF/Typeplanques/Edit/'.$id);
        }

        $typeplanque =  new Typeplanque($this->getDB());
        $result = $typeplanque->update($id,$_POST);

        if($result){
            return header('Location: /ECF/Typeplanques/1');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();
        $this->haveToken();

        $typeplanque = new Typeplanque($this->getDB());
        $result = $typeplanque->destroy($id);

        if($result){
            return header('Location: /ECF/Typeplanques/1');
        }
    }
}