<?php 

namespace App\Models;
use App\Models\Abstract\Model;

class Roles extends Model {

    protected $idname = 'roles_id';
    protected $table = 'ROLES';
    protected $roles_id;
    protected $name;

    public function getId() : int
    {
        return $this->roles_id;
    }

    public function getName() : string
    {
        return $this->name;
    }

}