<?php 

namespace App\Controllers;
use App\Models\Specialitys;
use App\Validation\Validator;


class SpecialityController extends Controller {

    public function index(int $page)
    {
        $this->isAdmin();

        $specialitys = new Specialitys($this->getDB());
        $dataarray = $specialitys->getElementsForPage($page);
        //Dans $dataarray[0] on recupere le nombre de page
        $nbPage = $dataarray[0];
        //Et ici on recupere les données a afficher
        $specialitys = $dataarray[1];

        return $this->view('Specialitys.index', compact('specialitys','nbPage','page'));
    }

    public function create()
    {
        $this->isAdmin();

        return $this->view('Specialitys.form');
    }

    public function created()
    {
        $this->isAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate(
            [
                'nameofspeciality' => ['required','max:30','min:1','notinjection'],
            ]
        );
        if($errors){
            $_SESSION['errors'] = $errors;
            return header('Location: /ECF/Specialitys/Create');
        }

        $speciality =  new Specialitys($this->getDB());
        $result = $speciality->create($_POST);

        if($result){
            return header('Location: /ECF/Specialitys/1');
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $speciality =  new Specialitys($this->getDB());
        $speciality = $speciality->findById($id);

        return $this->view('Specialitys.form', compact('speciality'));
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate(
            [
                'nameofspeciality' => ['required','max:30','min:1','notinjection'],
            ]
        );
        if($errors){
            $_SESSION['errors'] = $errors;
            return header('Location: /ECF/Specialitys/Edit/'.$id);
        }

        $speciality =  new Specialitys($this->getDB());
        $result = $speciality->update($id,$_POST);

        if($result){
            return header('Location: /ECF/Specialitys/1');
        }
    }

    public function destroy($id)
    {
        $this->isAdmin();
        $this->haveToken();

        $speciality =  new Specialitys($this->getDB());
        $result = $speciality->destroy($id);

        if($result){
            return header('Location: /ECF/Specialitys/1');
        }
    }
}