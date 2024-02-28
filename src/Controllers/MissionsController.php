<?php 

namespace App\Controllers;

use App\Models\Agents;
use App\Models\Cibles;
use App\Models\Contacts;
use App\Models\Missions;
use App\Models\Pays;
use App\Models\Planques;
use App\Models\Specialitys;
use App\Models\Statuts;
use App\Models\Typemission;
use App\Validation\Validator;

class MissionsController extends Controller{

    public function index(int $page)
    {
        $this->isAdmin();

        $missions = new Missions($this->getDB()); 
        $dataarray = $missions->getElementsForPage($page);
        //Dans $dataarray[0] on recupere le nombre de page
        $nbPage = $dataarray[0];
        //Et ici on recupere les données a afficher
        $missions = $dataarray[1];

        $types = new Typemission($this->getDB());
        $dataForFiltre = $types->all();

        return $this->view('Missions.index', compact('missions', 'nbPage', 'page', 'dataForFiltre'));
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $missions = new Missions($this->getDB());
        $pays =  new Pays($this->getDB());
        $statuts = new Statuts($this->getDB());
        $specialitys =  new Specialitys($this->getDB());
        $agents =  new Agents($this->getDB());
        $contacts = new Contacts($this->getDB());
        $cibles = new Cibles($this->getDB());
        $planques = new Planques($this->getDB());
        $typemissions = new Typemission($this->getDB());

        $statuts = $statuts->all();
        $pays = $pays->all();
        $specialitys = $specialitys->all();
        $agents = $agents->all();
        $contacts = $contacts->all();
        $cibles = $cibles->all();
        $planques = $planques->all();
        $mission = $missions->findById($id);
        $typemissions = $typemissions->all();

        return $this->view('Missions.form', compact('mission', 'pays', 'statuts', 'specialitys', 'agents', 'contacts', 'cibles', 'planques', 'typemissions'));
    }

    public function create()
    {
        $this->isAdmin();


        $pays =  new Pays($this->getDB());
        $statuts = new Statuts($this->getDB());
        $specialitys =  new Specialitys($this->getDB());
        $agents =  new Agents($this->getDB());
        $contacts = new Contacts($this->getDB());
        $cibles = new Cibles($this->getDB());
        $planques = new Planques($this->getDB());
        $typemissions = new Typemission($this->getDB());

        $statuts = $statuts->all();
        $pays = $pays->all();
        $specialitys = $specialitys->all();
        $agents = $agents->all();
        $contacts = $contacts->all();
        $cibles = $cibles->all();
        $planques = $planques->all();
        $typemissions = $typemissions->all();

        return $this->view('Missions.form' , compact('pays', 'statuts', 'specialitys', 'agents', 'contacts', 'cibles', 'planques', 'typemissions'));
    }

    public function created()
    {
        $this->isAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate(
            [
                'titre' => ['required','max:30','min:4','notinjection'],
                'description' => ['required','max:100','min:10','notinjection'],
                'codename' => ['required','max:30','min:4','notinjection'],
                'pays_id' => ['required','max:3','min:1','notinjection'],
                'type_id' => ['required','max:3','min:1','notinjection'],
                'statut_id' => ['required','max:3','min:1','notinjection'],
                'speciality_id' => ['required','max:3','min:1','notinjection'],
                'startdate' => ['required','notinjection'],
                'enddate' => ['required','notinjection'],
                'agent_id[]' => ['required','notinjection','max:3','min:1'],
                'contact_id[]' => ['required','notinjection','max:3','min:1'],
                'cible_id[]' => ['required','notinjection','max:3','min:1'],
                'planque_id[]' => ['required','notinjection','max:3','min:1']
            ]
        );
        if($errors){
            $_SESSION['errors'] = $errors;
            return header('Location: /ECF/Missions/Create');
        }

        $mission = new Missions($this->getDB());

        $dataMission = array_slice($_POST,0,9);
        $relations = array_slice($_POST,9,12);

        $result = $mission->create($dataMission,$relations);

        if($result){
            return header('Location: /ECF/Missions/1');
        }
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate(
            [
                'titre' => ['required','max:30','min:4','notinjection'],
                'description' => ['required','max:500','min:10','notinjection'],
                'codename' => ['required','max:30','min:4','notinjection'],
                'pays_id' => ['required','max:3','min:1','notinjection'],
                'type_id' => ['required','max:3','min:1','notinjection'],
                'statut_id' => ['required','max:3','min:1','notinjection'],
                'speciality_id' => ['required','max:3','min:1','notinjection'],
                'startdate' => ['required','notinjection'],
                'enddate' => ['required','notinjection'],
                'agent_id[]' => ['required','notinjection','max:3','min:1'],
                'contact_id[]' => ['required','notinjection','max:3','min:1'],
                'cible_id[]' => ['required','notinjection','max:3','min:1'],
                'planque_id[]' => ['required','notinjection','max:3','min:1']
            ]
        );
        if($errors){
            $_SESSION['errors'] = $errors;
            return header('Location: /ECF/Missions/Edit'.$id);
        }

        $mission =  new Missions($this->getDB());

        $dataMission = array_slice($_POST,0,9);
        $relations = array_slice($_POST,9,12);

        $result = $mission->update($id,$dataMission,$relations);

        if($result){
            return header('Location: /ECF/Missions/1');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();
        $this->haveToken();

        $mission = new Missions($this->getDB());

        $result = $mission->destroy($id);

        if($result){
            return header('Location: /ECF/Missions/1');
        }
    }

    public function filtre(int $typeId)
    {
        $this->isAdmin();

        $missions = new Missions($this->getDB());
        $missions = $missions->findByType($typeId);

        return $this->viewRender('Missions.table', compact('missions'));

    }

    public function recherche()
    {
        $this->isAdmin();

        $name = $_POST['nom'];

        $missions = new Missions($this->getDB());

        $missions = $missions->findByName($name);

        return $this->viewRender('Missions.table', compact('missions'));
    }

    public function welcome(?int $page = null)
    {
        if(!$page){
            $page = 1;
        }

        $missions =  new Missions($this->getDB());
        $dataarray = $missions->getElementsForPage($page);
        //Dans $dataarray[0] on recupere le nombre de page
        $nbPage = $dataarray[0];
        //Et ici on recupere les données a afficher
        $missions = $dataarray[1];

        return $this->view('Missions.welcome', compact('missions','nbPage','page'));
    }

    public function show(int $id)
    {
        $mission = new Missions($this->getDB());

        $mission = $mission->findById($id);

        return $this->view('Missions.show', compact('mission'));
    }

    public function recherchePublic()
    {
        $this->isAdmin();

        $name = $_POST['nom'];

        $missions = new Missions($this->getDB());

        $missions = $missions->findByName($name);

        return $this->viewRender('Missions.affiche', compact('missions'));
    }
}  