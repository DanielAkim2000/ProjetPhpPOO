<?php

namespace App\Models;

use App\Models\HumainofKgb;

class Cibles extends HumainofKgb{

    private $cible_id; 

    private $codename;

    private $idname = 'cible_id';

    public function getCodeName()
    {
        return $this->codename;
    }

}