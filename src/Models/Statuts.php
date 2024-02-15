<?php 

namespace App\Models;

use App\Models\Abstract\Model;

class Statuts extends Model{

    protected $table = 'STATUTS';
    private $statut_id;
    protected $idname ='statut_id'; 
    private $statut;

    public function getId()
    {
        return $this->statut_id;
    }

    public function getNameStatut() : string 
    {
        return $this->statut;
    }
}