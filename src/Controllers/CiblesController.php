<?php 

namespace App\Controllers;

use App\Models\Cibles;
use App\Models\Missions;
use App\Models\Pays;

class CiblesController extends Controller{

    function index()
    {
        $this->isAdmin();

        $cibles = new Cibles($this->getDB());
        $cibles = $cibles->all();
        
        return $this->view('Cibles.index',compact('cibles'));
    }

    public function create()
    {
        $this->isAdmin();

        $pays = new Pays($this->getDB());

        $pays = $pays->all();

        return $this->view('Cibles.form', compact('pays'));
    }

    public function created()
    {
        $this->isAdmin();

        $cible = new Cibles($this->getDB());
        $dataCible = array_slice($_POST,0,1);
        $dataHumain = array_slice($_POST, 1,2);
        $dataHkgb = array_slice($_POST,3,2);

        $result = $cible->create($dataCible,null,$dataHumain,$dataHkgb);

        if($result){
            return header('Location: /ECF/Cibles ');
        }
    }

    public function edit($id)
    {
        $this->isAdmin();

        $pays = new Pays($this->getDB());
        $cible = new Cibles($this->getDB());

        $pays = $pays->all();
        $cible = $cible->findById($id);

        return $this->view('Cibles.form', compact('pays', 'cible'));
    }

    public function update($id)
    {
        $this->isAdmin();

        $cible = new Cibles($this->getDB());
        
        $dataCible = array_slice($_POST,0,1);
        $dataHumain = array_slice($_POST, 1,2);
        $dataHkgb = array_slice($_POST,3,2);
        
        $result = $cible->update($id,$dataCible,$dataHkgb,$dataHumain);

        if($result){
            return header('Location: /ECF/Cibles');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();

        $cible =  new Cibles($this->db);
        $cible = $cible->findById($id);

        $humainkgbId = $cible->getHumainKgbInfo()->getId();

        $result = $cible->destroy($id,$humainkgbId);

        if($result){
            return header('Location: /ECF/Cibles');
        }
    }
}