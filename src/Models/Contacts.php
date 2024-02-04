<?php

namespace App\Models;

class Contacts extends HumainofKgb{

    private int $contact_id; 

    private string $codename;

    private $idname = 'contact_id';

    public function getCodeName()
    {
        return $this->codename;
    }

}