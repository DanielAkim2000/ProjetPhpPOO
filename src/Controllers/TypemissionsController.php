<?php 

namespace App\Controllers;
use App\Models\Typemission;
use App\Validation\Validator;

class TypemissionsController extends Controller {

    public function index(int $page)
    {
        $this->isAdmin();

        $typemissions = new Typemission($this->getDB());
        $dataarray = $typemissions->getElementsForPage($page);
        //Dans $dataarray[0] on recupere le nombre de page
        $nbPage = $dataarray[0];
        //Et ici on recupere les données a afficher
        $typemissions = $dataarray[1];

        return $this->view('Typemissions.index', compact('typemissions', 'nbPage' ,'page'));
    }

    public function create()
    {
        $this->isAdmin();

        return $this->view('Typemissions.form');
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
            return header('Location: /ECF/Typemissions/Create');
        }

        $typemissions = new Typemission($this->getDB());
        $result = $typemissions->create($_POST);

        if($result){
            return header('Location: /ECF/Typemissions/1');
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $typemission = new Typemission($this->getDB());
        $typemission = $typemission->findById($id);

        return $this->view('Typemissions.form', compact('typemission'));
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
            return header('Location: /ECF/Typemissions/Create');
        }

        $typemission =  new Typemission($this->getDB());
        $result = $typemission->update($id, $_POST);

        if($result){
            return header('Location: /ECF/Typemissions/1');
        }
    }

    public function destroy($id)
    {
        $this->isAdmin();
        $this->haveToken();

        $typemission =  new Typemission($this->getDB());
        $result = $typemission->destroy($id);

        if($result){
            return header('Location: /ECF/Typemissions/1');
        }
    }
}