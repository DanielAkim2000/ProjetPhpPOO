<?php 

namespace App\Models;

use App\Models\HumainofKgb;
use DateTime;

class Administrateurs extends Humain{

    private $admin_id;

    private string $email;

    private $password;

    private $datedecreation;

    private $idname = 'admin_id';


    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDateDeCreation() : DateTime
    {
        return $this->datedecreation;
    }
}