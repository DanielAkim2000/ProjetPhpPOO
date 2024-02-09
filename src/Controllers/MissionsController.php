<?php 

namespace App\Controllers;

use App\Models\Missions;

class MissionsController extends Controller{

    public function index()
    {
       $missions = new Missions($this->getDB()); 
       $missions = $missions->all();

       return $this->view('Missions.index', compact('missions'));
    }
}  