<?php 

namespace App\Models;

use App\Models\Abstract\Model;

class Specialitys extends Model{

    protected $table = 'specialitys';
    protected $idname = 'speciality_id';
    private $speciality_id;
    private $nameofspeciality;
    
    public function getNameOfSpeciality() : string 
    {
        return $this->nameofspeciality;
    }
}