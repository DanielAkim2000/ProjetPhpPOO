<?php

namespace App\Models;
use App\Models\Abstract\Model;

class Typeplanque extends Model{

    protected $table = 'TYPEPLANQUE';
    protected $idname='type_id';
    public $type_id;
    private $description;

    public function getNameType() : string 
    {
        return $this->description;
    }
}