<?php 

namespace App\Controllers;
use App\Models\Statuts;

class StatutsController extends Controller {

    public function index()
    {
        $this->isAdmin();

        $statuts = new Statuts($this->getDB());
        $statuts = $statuts->all();

        return $this->view('Statuts.index', compact('statuts'));
    }

    public function create()
    {
        $this->isAdmin();

        return $this->view('Statuts.form');
    }

    public function created()
    {
        $this->isAdmin();

        $statuts = new Statuts($this->getDB());
        $result = $statuts->create($_POST);

        if($result){
            return header('Location: /ECF/Statuts');
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $statut = new Statuts($this->getDB());
        $statut = $statut->findById($id);

        return $this->view('Statuts.form', compact('statut'));
    }

    public function update(int $id)
    {
        $this->isAdmin();

        $statut = new Statuts($this->getDB());
        $result = $statut->update($id,$_POST);

        if($result){
            return header('Location: /ECF/Statuts');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();

        $statut = new Statuts($this->getDB());
        $result = $statut->destroy($id);

        if($result){
            return header('Location: /ECF/Statuts');
        }
    }
}