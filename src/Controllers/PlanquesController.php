<?php 

namespace App\Controllers;

use App\Models\Pays;
use App\Models\Planques;
use App\Models\Typeplanque;

class PlanquesController extends Controller{

    public function index()
    {
        $planques = new Planques($this->getDB());
        $planques = $planques->all();

        return $this->view('Planques.index', compact('planques'));
    }

    public function destroy(int $id)
    {
        $planques = new Planques($this->getDB());
        $result = $planques->destroy($id);

        if($result){
            return header('Location: /ECF/Planques');
        }
    }

    public function edit(int $id)
    {
        $planques = new Planques($this->getDB());
        $planque = $planques->findById($id);

        $pays = new Pays($this->getDB());
        $pays = $pays->all();

        $typeplanques = new Typeplanque($this->getDB());
        $typeplanques = $typeplanques->all();

        return $this->view('Planques.edit', compact('planque','pays','typeplanques'));
    }

    public function update(int $id)
    {
        $planques = new Planques($this->getDB());

        $relations['pays_id'] = array_pop($_POST);
        $relations['typeplanque_id'] = array_pop($_POST);

        $result = $planques->update($id, $_POST, $relations);

        if($result){
            return header('Location: /ECF/Planques');
        }
    }


}