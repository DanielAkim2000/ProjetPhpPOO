<?php 

namespace App\Controllers;

use App\Models\Cibles;
use App\Models\Missions;
use App\Models\Pays;
use App\Validation\Validator;

class CiblesController extends Controller{

    function index(int $page)
    {
        $this->isAdmin();

        $cibles = new Cibles($this->getDB());
        $pays = new Pays($this->getDB());

        $dataarray = $cibles->getElementsForPage($page);
        //Dans $dataarray[0] on recupere le nombre de page
        $nbPage = $dataarray[0];
        //Et ici on recupere les données a afficher
        $cibles = $dataarray[1];
        $dataForFiltre = $pays->all();
        
        
        return $this->view('Cibles.index',compact('cibles','nbPage', 'page', 'dataForFiltre'));
    }

    public function create()
    {
        $this->isAdmin();

        $pays = new Pays($this->getDB());

        $pays = $pays->all();

        return $this->view('Cibles.form', compact('pays'));
    }

    public function created()
    {
        $this->isAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];
        
        $validator = new Validator($_POST);
        $errors = $validator->validate(
            [
                'codename' => ['required','notinjection','max:20'],
                'firstname' => ['required','notinjection', 'max:20'],
                'lastname' => ['required' ,'notinjection', 'max:20'],
                'nationality_id' => ['required', 'notinjection', 'max:3'],
                'birthday' => ['required', 'notinjection', 'max:11']
            ]
        );
        if($errors){
            $_SESSION['errors'] = $errors;
            return header('Location: /ECF/Cibles/Create');
        }

        $cible = new Cibles($this->getDB());
        $dataCible = array_slice($_POST,0,1);
        $dataHumain = array_slice($_POST, 1,2);
        $dataHkgb = array_slice($_POST,3,2);

        $result = $cible->create($dataCible,null,$dataHumain,$dataHkgb);

        if($result){
            return header('Location: /ECF/Cibles/1 ');
        }
    }

    public function edit($id)
    {
        $this->isAdmin();

        $pays = new Pays($this->getDB());
        $cible = new Cibles($this->getDB());

        $pays = $pays->all();
        $cible = $cible->findById($id);

        return $this->view('Cibles.form', compact('pays', 'cible'));
    }

    public function update($id)
    {
        $this->isAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate(
            [
                'codename' => ['required','notinjection','max:20'],
                'firstname' => ['required','notinjection', 'max:20'],
                'lastname' => ['required' ,'notinjection', 'max:20'],
                'nationality_id' => ['required', 'notinjection', 'max:3'],
                'birthday' => ['required', 'notinjection', 'max:11']
            ]
        );
        if($errors){
            $_SESSION['errors'] = $errors;
            return header('Location: /ECF/Cibles/Edit/'.$id);
        }

        $cible = new Cibles($this->getDB());
        
        $dataCible = array_slice($_POST,0,1);
        $dataHumain = array_slice($_POST, 1,2);
        $dataHkgb = array_slice($_POST,3,2);
        
        $result = $cible->update($id,$dataCible,$dataHkgb,$dataHumain);

        if($result){
            return header('Location: /ECF/Cibles/1');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();
        $this->haveToken();

        $cible =  new Cibles($this->db);
        $cible = $cible->findById($id);

        $humainkgbId = $cible->getHumainKgbInfo()->getId();

        $result = $cible->destroy($id,$humainkgbId);

        if($result){
            return header('Location: /ECF/Cibles/1');
        }
    }

    public function filtre(int $idpays)
    {
        $this->isAdmin();
        
        $cibles = new Cibles($this->getDB());
        $cibles = $cibles->findByNationality($idpays);

        return $this->viewRender('Cibles.table', compact('cibles'));
    }

    public function recherche()
    {
        $this->isAdmin();

        $name = $_POST['nom'];
        $cibles = new Cibles($this->getDB());
        $cibles = $cibles->findByName($name);

        return $this->viewRender('Cibles.table', compact('cibles'));
    }
}