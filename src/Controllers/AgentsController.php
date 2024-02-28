<?php 

namespace App\Controllers;

use App\Models\Agents;
use App\Models\Humain;
use App\Models\HumainofKgb;
use App\Models\Missions;
use App\Models\Pays;
use App\Models\Specialitys;
use App\Validation\Validator;

class AgentsController extends Controller {

    public function welcome()
    {
        return $this->view('Agents.welcome');
    }
    public function index(int $page)
    {
        $this->isAdmin();
        
        $agent = new Agents($this->getDB());
        $dataarray = $agent->getElementsForPage($page);
        //Dans $dataarray[0] on recupere le nombre de page
        $nbPage = $dataarray[0];
        //Et ici on recupere les données a afficher
        $agents = $dataarray[1];
        $pays = new Pays($this->getDB());
        $dataForFiltre = $pays->all();

        return $this->view('Agents.index', compact('agents','nbPage', 'page', 'dataForFiltre'));
    }

    public function show(int $id)
    {
        $this->isAdmin();

        $agent = new Agents($this->getDB());
        $agents = $agent->findById($id);

        return $this->view('Agents.show', compact('agents'));
    }

    public function create()
    {
        $this->isAdmin();

        $specialitys = new Specialitys($this->getDB());
        $missions = new Missions($this->getDB());
        $pays = new Pays($this->getDB());

        $pays = $pays->all();
        $specialitys = $specialitys->all();
        $missions = $missions->all();

        return $this->view('Agents.form', compact('missions','specialitys','pays'));
    }

    public function created()
    {
        $this->isAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'firstname' => ['required','notinjection', 'max:20'],
            'lastname' => ['required' ,'notinjection', 'max:20'],
            'codeofidentification' => ['required', 'notinjection', 'max:20'],
            'nationality_id' => ['required', 'notinjection', 'max:1'],
            'birthday' => ['required', 'notinjection', 'max:11'],
            'mission_id[]' => ['required', 'notinjection'],
            'speciality_id[]' => ['required', 'notinjection']

        ]);

        if ($errors){
            $_SESSION['errors'] = $errors;
            header('Location: /ECF/Agents/Create');
            exit;
        }

        $agent = new Agents($this->getDB());
        $relations = array_slice($_POST,5);
        $dataAgent = array_slice($_POST,0,1);
        $dataHumain = array_slice($_POST, 1,2);
        $dataHkgb = array_slice($_POST,3,2);
        
        $result = $agent->create($dataAgent,$relations,$dataHumain,$dataHkgb);

        if($result){
            return header('Location: /ECF/Agents ');
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $agent = new Agents($this->getDB());
        $pays = new Pays($this->getDB());
        $specialitys = new Specialitys($this->getDB());
        $missions = new Missions($this->getDB());

        $pays = $pays->all();
        $agent = $agent->findById($id);
        $specialitys = $specialitys->all();
        $missions = $missions->all();

        return $this->view('Agents.form', compact('agent', 'pays', 'specialitys', 'missions'));
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $this->haveToken();

        //Reintialisationd des erreurs a 0
        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'firstname' => ['required','notinjection', 'max:20'],
            'lastname' => ['required' ,'notinjection', 'max:20'],
            'codeofidentification' => ['required', 'notinjection', 'max:20'],
            'nationality_id' => ['required', 'notinjection', 'max:15'],
            'birthday' => ['required', 'notinjection', 'max:11'],
            'mission_id[]' => ['required', 'notinjection'],
            'speciality_id[]' => ['required', 'notinjection']

        ]);

        if ($errors){
            $_SESSION['errors'] = $errors;
            header('Location: /ECF/Agents/Edit/'.$id);
            exit;
        }

        $agent = new Agents($this->getDB());
        
        $relations = array_slice($_POST,5);
        $dataAgent = array_slice($_POST,0,1);
        $dataHumain = array_slice($_POST, 1,2);
        $dataHkgb = array_slice($_POST,3,2);

        $result = $agent->update($id,$dataAgent,$dataHkgb,$dataHumain,$relations);

        if($result){
            return header('Location: /ECF/Agents/1 ');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();
        $this->haveToken();

        $agent = new Agents($this->getDB());
        $agent = $agent->findById($id);
        //Je recupere son champ humainkgb_id pour pouvoir l'inserer dans la fonction destroy qui a besoin des deux parametres pour faire la suppression
        $humainkgbId = $agent->getHumainKgbInfo()->getId();
        $result = $agent->destroy($id,$humainkgbId);
        
        if($result){
            return header('Location: /ECF/Agents/1');
        }
    }

    public function trie(int $id)
    {
        $this->isAdmin();
        $this->haveToken();

        $agents = new Agents($this->getDB());
        $agents = $agents->all();


        return $this->view('Agents.index', compact('agents','nbPage', 'page', 'dataForFiltre'));
    }

    public function filtre(int $idpays)
    {
        $this->isAdmin();
        
        $agents = new Agents($this->getDB());
        $agents = $agents->findByNationality($idpays);

        return $this->viewRender('Agents.table', compact('agents'));
    }

    public function recherche()
    {
        $this->isAdmin();


        $name = $_POST['nom'];
        $agents = new Agents($this->getDB());
        $agents = $agents->findByName($name);

        return $this->viewRender('Agents.table', compact('agents'));
    }
}