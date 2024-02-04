<?php

namespace App\Models\Abstract;

abstract class Humain extends Model{

    protected string $lastname;

    protected string $firstname;

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string 
    {
        return $this->firstname;
    }
}