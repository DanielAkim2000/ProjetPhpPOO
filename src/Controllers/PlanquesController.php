<?php 

namespace App\Controllers;

use App\Models\Pays;
use App\Models\Planques;
use App\Models\Typeplanque;

class PlanquesController extends Controller{

    public function index()
    {
        $this->isAdmin();

        $planques = new Planques($this->getDB());
        $planques = $planques->all();

        return $this->view('Planques.index', compact('planques'));
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

        $planque = new Planques($this->getDB());

        $result = $planque->create($_POST);

        if($result){
            return header('Location: /ECF/Planques ');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();

        $planques = new Planques($this->getDB());
        $result = $planques->destroy($id);

        if($result){
            return header('Location: /ECF/Planques');
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

        $planques = new Planques($this->getDB());

        $result = $planques->update($id, $_POST);

        if($result){
            return header('Location: /ECF/Planques');
        }
    }


}