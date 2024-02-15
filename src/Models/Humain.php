<?php

namespace App\Models;

use App\Models\Abstract\Model;
use PDO;

class Humain extends Model{

    protected $table = 'HUMAIN';
    protected $idname = 'humain_id';
    public $lastname;
    public $firstname;
    public $humain_id;

    public function getId() : int
    {
        return $this->humain_id;
    }

    public function getFirstname() : string 
    {
        return $this->firstname;
    }

    public function getLastname() : string 
    {
        return $this->lastname;
    }
}