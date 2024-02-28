<?php 

namespace App\Controllers;

use App\Models\Pays;
use App\Models\Planques;
use App\Models\Typeplanque;
use App\Validation\Validator;

class PlanquesController extends Controller{

    public function index(int $page)
    {
        $this->isAdmin();

        $planques = new Planques($this->getDB());
        $type = new Typeplanque($this->getDB());

        $dataarray = $planques->getElementsForPage($page);
        //Dans $dataarray[0] on recupere le nombre de page
        $nbPage = $dataarray[0];
        //Et ici on recupere les données a afficher
        $planques = $dataarray[1];

        $dataForFiltre = $type->all();


        return $this->view('Planques.index', compact('planques','nbPage', 'page', 'dataForFiltre'));
    }

    public function create()
    {
        $this->isAdmin();

        $pays = new Pays($this->getDB());
        $pays = $pays->all();

        $typeplanques = new Typeplanque($this->getDB());
        $typeplanques = $typeplanques->all();

        return $this->view('Planques.form', compact('typeplanques','pays'));
    }

    public function created()
    {
        $this->isAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate(
            [
                'code' => ['required','min:1','max:10','notinjection'],
                'typeplanque_id' => ['required','min:1','max:1','notinjection'],
                'pays_id' => ['required','min:1','max:2','notinjection']
            ]
        );
        if($errors){
            $_SESSION['errors'] = $errors;
            return header('Location: /ECF/Planques/Create');
        }

        $planque = new Planques($this->getDB());

        $result = $planque->create($_POST);

        if($result){
            return header('Location: /ECF/Planques/1 ');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();
        $this->haveToken();

        $planques = new Planques($this->getDB());
        $result = $planques->destroy($id);

        if($result){
            return header('Location: /ECF/Planques/1');
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $planques = new Planques($this->getDB());
        $planque = $planques->findById($id);

        $pays = new Pays($this->getDB());
        $pays = $pays->all();

        $typeplanques = new Typeplanque($this->getDB());
        $typeplanques = $typeplanques->all();

        return $this->view('Planques.form', compact('planque','pays','typeplanques'));
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate(
            [
                'code' => ['required','min:1','max:10','notinjection'],
                'typeplanque_id' => ['required','min:1','max:3','notinjection'],
                'pays_id' => ['required','min:1','max:3','notinjection']
            ]
        );
        if($errors){
            $_SESSION['errors'] = $errors;
            return header('Location: /ECF/Planques/Edit'.$id);
        }

        $planques = new Planques($this->getDB());

        $result = $planques->update($id, $_POST);

        if($result){
            return header('Location: /ECF/Planques/1');
        }
    }

    public function filtre(int $idTypePlanques)
    {
        $this->isAdmin();

        $planques = new Planques($this->getDB());

        $planques = $planques->findByTypePlanque($idTypePlanques);

        return $this->viewRender('Planques.table', compact('planques'));
    }

    public function recherche()
    {
        $this->isAdmin();

        $name = $_POST['nom'];
        $planques = new Planques($this->getDB());
        $planques = $planques->findByName($name);

        return $this->viewRender('Planques.table', compact('planques'));
    }

}