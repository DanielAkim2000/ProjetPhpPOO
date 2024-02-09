<?php

namespace App\Models;

use App\Models\Abstract\Model;
use PDO;

class Humain extends Model{

    public $lastname;
    public $firstname;

    public $humain_id;

    public function getFirstname() : string 
    {
        return $this->firstname;
    }

    public function getLastname() : string 
    {
        return $this->lastname;
    }
}