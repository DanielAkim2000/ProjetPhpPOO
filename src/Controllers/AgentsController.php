<?php 

namespace App\Controllers;

use App\Models\Agents;
use App\Models\HumainofKgb;
use App\Models\Pays;
use Exception;

class AgentsController extends Controller {

    public function welcome()
    {
        return $this->view('Agents.welcome');
    }
    public function index()
    {
        $agent = new Agents($this->getDB());
        $agents = $agent->all();

        return $this->view('Agents.index', compact('agents'));
    }

    public function show(int $id)
    {
        $agent = new Agents($this->getDB());
        $agents = $agent->findById($id);

        return $this->view('Agents.show', compact('agents'));
    }
}