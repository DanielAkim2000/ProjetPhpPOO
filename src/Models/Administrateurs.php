<?php 

namespace App\Models;

use DateTime;

class Administrateurs extends Humain{

    private int $admin_id;

    private string $email;

    private string $password;

    private DateTime $datedecreation;

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