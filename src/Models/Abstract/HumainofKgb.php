<?php 

namespace App\Models\Abstract;

use DateTime;

abstract class HumainofKgb extends Humain{

    private Pays $nationality_id;

    private DateTime $birthday;

    public function getNationality()
    {
        return $this->nationality_id->getName();
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

}