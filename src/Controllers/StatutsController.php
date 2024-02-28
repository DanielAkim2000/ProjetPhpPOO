<?php 

namespace App\Controllers;
use App\Models\Statuts;
use App\Validation\Validator;

class StatutsController extends Controller {

    public function index(int $page)
    {
        $this->isAdmin();

        $statuts = new Statuts($this->getDB());
        $dataarray = $statuts->getElementsForPage($page);
        //Dans $dataarray[0] on recupere le nombre de page
        $nbPage = $dataarray[0];
        //Et ici on recupere les données a afficher
        $statuts = $dataarray[1];

        return $this->view('Statuts.index', compact('statuts', 'nbPage' ,'page'));
    }

    public function create()
    {
        $this->isAdmin();

        return $this->view('Statuts.form');
    }

    public function created()
    {
        $this->isAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate(
            [
                'statut' => ['required','max:30','min:1','notinjection'],
            ]
        );
        if($errors){
            $_SESSION['errors'] = $errors;
            return header('Location: /ECF/Statuts/Create');
        }

        $statuts = new Statuts($this->getDB());
        $result = $statuts->create($_POST);

        if($result){
            return header('Location: /ECF/Statuts/1');
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $statut = new Statuts($this->getDB());
        $statut = $statut->findById($id);

        return $this->view('Statuts.form', compact('statut'));
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate(
            [
                'statut' => ['required','max:30','min:1','notinjection'],
            ]
        );
        if($errors){
            $_SESSION['errors'] = $errors;
            return header('Location: /ECF/Statuts/Edit/'.$id);
        }

        $statut = new Statuts($this->getDB());
        $result = $statut->update($id,$_POST);

        if($result){
            return header('Location: /ECF/Statuts/1');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();
        $this->haveToken();

        $statut = new Statuts($this->getDB());
        $result = $statut->destroy($id);

        if($result){
            return header('Location: /ECF/Statuts/1');
        }
    }
}