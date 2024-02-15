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

class MissionsController extends Controller{

    public function index()
    {
        $this->isAdmin();

        $missions = new Missions($this->getDB()); 
        $missions = $missions->all();

        return $this->view('Missions.index', compact('missions'));
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

        $mission = new Missions($this->getDB());

        $dataMission = array_slice($_POST,0,9);
        $relations = array_slice($_POST,9,12);

        $result = $mission->create($dataMission,$relations);

        if($result){
            return header('Location: /ECF/Missions');
        }
    }

    public function update(int $id)
    {
        $this->isAdmin();

        $mission =  new Missions($this->getDB());

        $dataMission = array_slice($_POST,0,9);
        $relations = array_slice($_POST,9,12);

        $result = $mission->update($id,$dataMission,$relations);

        if($result){
            return header('Location: /ECF/Missions');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();

        $mission = new Missions($this->getDB());

        $result = $mission->destroy($id);

        if($result){
            return header('Location: /ECF/Missions');
        }
    }
    
}  