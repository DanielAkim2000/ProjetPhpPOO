<?php 

namespace App\Models;

use App\Models\Abstract\Model;

class Missions extends Model{

    private string $mission_id;
    private string $titre;
    private string $description;
    private string $codename;
    private Pays $pays;
    private Type $type;
    private Statut $statut;

    public function setTitre(string $titre)
    {
        $this->titre = $titre;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function setPays(Pays $pays)
    {
        $this->pays = $pays;
    }

    public function setType(Type $type)
    {
        $this->type = $type;
    }

    public function setStatut(Statut $statut)
    {
        $this->statut = $statut;
    }


}