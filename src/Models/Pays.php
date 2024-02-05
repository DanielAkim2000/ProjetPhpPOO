<?php 

namespace App\Models;

use App\Models\Abstract\Model;

class Pays extends Model{
    
    protected $table = 'pays';
    protected $idname = 'pays_id';

    protected $name;

    private $pays_id;

    public function getName(): string
    {
        return $this->name;
    }

    public function getButton() : string
    {
        return <<<HTML
        <a href="/ECF/Pays/$this->pays_id" class="btn btn-primary w-25 m-auto">Voir</a>
        HTML;
    }
}