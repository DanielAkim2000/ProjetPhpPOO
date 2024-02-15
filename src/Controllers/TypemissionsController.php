<?php 

namespace App\Controllers;
use App\Models\Typemission;

class TypemissionsController extends Controller {

    public function index()
    {
        $this->isAdmin();

        $typemissions = new Typemission($this->getDB());
        $typemissions = $typemissions->all();

        return $this->view('Typemissions.index', compact('typemissions'));
    }

    public function create()
    {
        $this->isAdmin();

        return $this->view('Typemissions.form');
    }

    public function created()
    {
        $this->isAdmin();

        $typemissions = new Typemission($this->getDB());
        $result = $typemissions->create($_POST);

        if($result){
            return header('Location: /ECF/Typemissions');
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $typemission = new Typemission($this->getDB());
        $typemission = $typemission->findById($id);

        return $this->view('Typemissions.form', compact('typemission'));
    }

    public function update(int $id)
    {
        $this->isAdmin();

        $typemission =  new Typemission($this->getDB());
        $result = $typemission->update($id, $_POST);

        if($result){
            return header('Location: /ECF/Typemissions');
        }
    }

    public function destroy($id)
    {
        $this->isAdmin();

        $typemission =  new Typemission($this->getDB());
        $result = $typemission->destroy($id);

        if($result){
            return header('Location: /ECF/Typemissions');
        }
    }
}