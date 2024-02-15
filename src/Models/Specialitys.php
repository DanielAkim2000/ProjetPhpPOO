<?php 

namespace App\Models;

use App\Models\Abstract\Model;

class Specialitys extends Model{

    protected $table = 'specialitys';
    protected $idname = 'speciality_id';
    public $speciality_id;
    private $nameofspeciality;

    public function getId() : int
    {
        return $this->speciality_id;
    }
    
    public function getNameOfSpeciality() : string 
    {
        return $this->nameofspeciality;
    }
}