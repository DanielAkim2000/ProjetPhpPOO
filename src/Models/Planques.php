<?php 

namespace App\Models;

use App\Models\Abstract\Model;

class Planques extends Model{
    
    protected $table = 'planques';
    protected $idname = 'planque_id';
    public $planque_id;
    private $code;
    public $typeplanque_id;
    private $pays_id;

    public function getId() : int 
    {
        return $this->planque_id;
    }

    public function getCode() : string 
    {
        return $this->code;
    }

    public function getType() : Typeplanque
    {
        $result = $this->query(
            "
            SELECT t.* FROM TYPEPLANQUE t
            INNER JOIN PLANQUES p ON p.typeplanque_id = t.type_id
            WHERE p.planque_id = ?
            ",
            [$this->planque_id],
            true,
            get_class(new Typeplanque($this->db))
        );

        return $result;
    }

    public function getPays() : Pays
    {
        $result = $this->query(
            "
            SELECT p.* FROM PAYS p 
            INNER JOIN PLANQUES pl ON p.pays_id = pl.pays_id
            WHERE pl.planque_id = ?
            ",
            [$this->planque_id],
            true,
            get_class(new Pays($this->db))
        );

        return $result;
    }

    // public function update(int $id, array $data,?array $relations=null) : bool
    // {
    //     parent::update($id,$data);

    //     $stmt = $this->db->getPDO()->prepare("UPDATE PLANQUES SET pays_id = ?, typeplanque_id = ? WHERE planque_id = ?");
    //     $result = $stmt->execute([$relations['pays_id'],$relations['typeplanque_id'],$id]);

    //     return $result ;
    // }
    
}