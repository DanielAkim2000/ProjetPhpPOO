<?php 

namespace App\Controllers;
use App\Models\Specialitys;


class SpecialityController extends Controller {

    public function index()
    {
        $this->isAdmin();

        $specialitys = new Specialitys($this->getDB());
        $specialitys = $specialitys->all();

        return $this->view('Specialitys.index', compact('specialitys'));
    }

    public function create()
    {
        $this->isAdmin();

        return $this->view('Specialitys.form');
    }

    public function created()
    {
        $this->isAdmin();

        $speciality =  new Specialitys($this->getDB());
        $result = $speciality->create($_POST);

        if($result){
            return header('Location: /ECF/Specialitys');
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $speciality =  new Specialitys($this->getDB());
        $speciality = $speciality->findById($id);

        return $this->view('Specialitys.form', compact('speciality'));
    }

    public function update(int $id)
    {
        $this->isAdmin();

        $speciality =  new Specialitys($this->getDB());
        $result = $speciality->update($id,$_POST);

        if($result){
            return header('Location: /ECF/Specialitys');
        }
    }

    public function destroy($id)
    {
        $this->isAdmin();

        $speciality =  new Specialitys($this->getDB());
        $result = $speciality->destroy($id);

        if($result){
            return header('Location: /ECF/Specialitys');
        }
    }
}