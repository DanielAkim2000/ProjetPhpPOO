<?php

namespace App\Models;

use App\Models\HumainofKgb;

class Contacts extends HumainofKgb{

    private $contact_id; 

    private $codename;

    private $idname = 'contact_id';

    public function getCodeName()
    {
        return $this->codename;
    }

}