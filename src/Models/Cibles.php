<?php

namespace App\Models;

class Cibles extends HumainofKgb{

    private int $cible_id; 

    private string $codename;

    private $idname = 'cible_id';

    public function getCodeName()
    {
        return $this->codename;
    }

}