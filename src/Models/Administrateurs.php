<?php 

namespace App\Models;

use App\Models\HumainofKgb;
use DateTime;

class Administrateurs extends Humain{

    protected $idname = 'admin_id';
    protected $table = 'ADMINISTRATEURS';
    private $admin_id;

    private $email;

    private $password;

    private $dateofcreation;

    public function getId() : int
    {
        return $this->admin_id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDateDeCreation() : DateTime
    {
        return $this->dateofcreation;
    }

    public function getByEmail(string $email)
    {
        return $this->query("SELECT * FROM ADMINISTRATEURS WHERE email = ?",[$email],true);
    }

    public function getPassword() : string
    {
        return $this->password;
    }
}