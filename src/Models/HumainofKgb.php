<?php 

namespace App\Models;

use App\Models\Abstract\Model;
use App\Models\Pays;
use DateTime;

class HumainofKgb extends Humain{
    
    protected $nationality_id;

    public $name;
    public $birthday;

    public $humainkgb_id;

   public function getHumain() : Humain
   {
        return $this->query(
            "
            SELECT h.* FROM HUMAIN h
            INNER JOIN HUMAINOFKGB hk ON hk.humain_id = h.humain_id
            WHERE hk.humainkgb_id = ?
            ",
            $this->humainkgb_id,true,get_class(new Humain($this->db))
        );
   }

    public function getNationality()
    {
        $result = $this->query(
            "
            SELECT p.name FROM PAYS p
            INNER JOIN HUMAINOFKGB h ON h.nationality_id = p.pays_id
            WHERE h.humainkgb_id = ?
            "
            ,$this->humainkgb_id,true,get_class(new Pays($this->db))
        );

        return $result->getName();
    }

    public function getBirthday()
    {
        $result = $this->query(
            "
            SELECT birthday FROM HUMAINOFKGB WHERE humainkgb_id = ?
            ",
            $this->humainkgb_id,true
        );
        
        return $result->birthday;
    }

}