<?php

namespace App\Models;
use App\Models\Abstract\Model;

class Type extends Model{

    protected $table = 'TYPEMISSION';
    protected $idname='type_id';
    private $type_id;
    private $description;

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }
}