<?php

namespace App\Models;
use App\Models\Abstract\Model;

class Typemission extends Model{

    protected $table = 'TYPEMISSION';
    protected $idname='type_id';
    private $type_id;
    private $description;

    public function getId() : int
    {
        return $this->type_id;
    }

    public function getNameType() : string 
    {
        return $this->description;
    }

    public function getNameForFiltre()
    {
        return $this->description;
    }
}