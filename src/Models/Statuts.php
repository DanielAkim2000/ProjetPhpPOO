<?php 

namespace App\Models;

use App\Models\Abstract\Model;

class Statut extends Model{

    protected $table = 'STATUTS';
    private $statut_id;
    protected $idname ='statut_id'; 
    private string $statut;

    public function getStatut()
    {
        return $this->statut;
    }
}