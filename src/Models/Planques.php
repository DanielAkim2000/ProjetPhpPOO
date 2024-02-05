<?php 

namespace App\Models;

use App\Models\Abstract\Model;

class Planques extends Model{
    
    protected $table = 'planques';
    protected $idname = 'planque_id';
    private $planque_id;
    private $code;
    private $typeplanque_id;
    private $pays_id;

    public function setCode(string $code)
    {
        $this->code = $code;
    }
    
}