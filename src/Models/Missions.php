<?php 

namespace App\Models;

use App\Models\Abstract\Model;

class Missions extends Model{

    private string $mission_id;
    private string $titre;
    private string $description;
    private string $codename;
    private int $pays_id;
    private int $type_id;
    private int $statut_id;
}