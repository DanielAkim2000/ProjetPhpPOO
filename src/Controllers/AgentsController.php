<?php 

namespace App\Controllers;

use App\Models\Agents;
use App\Models\Humain;
use App\Models\HumainofKgb;
use App\Models\Missions;
use App\Models\Pays;
use App\Models\Specialitys;

class AgentsController extends Controller {

    public function welcome()
    {
        return $this->view('Agents.welcome');
    }
    public function index()
    {
        $this->isAdmin();
        
        $agent = new Agents($this->getDB());
        $agents = $agent->all();

        return $this->view('Agents.index', compact('agents'));
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

        $agent = new Agents($this->getDB());
        
        $relations = array_slice($_POST,5);
        $dataAgent = array_slice($_POST,0,1);
        $dataHumain = array_slice($_POST, 1,2);
        $dataHkgb = array_slice($_POST,3,2);

        $result = $agent->update($id,$dataAgent,$dataHkgb,$dataHumain,$relations);

        if($result){
            return header('Location: /ECF/Agents ');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();

        $agent = new Agents($this->getDB());
        $agent = $agent->findById($id);
        //Je recupere son champ humainkgb_id pour pouvoir l'inserer dans la fonction destroy qui a besoin des deux parametres pour faire la suppression
        $humainkgbId = $agent->getHumainKgbInfo()->getId();
        $result = $agent->destroy($id,$humainkgbId);
        
        if($result){
            return header('Location: /ECF/Agents');
        }
    }
}