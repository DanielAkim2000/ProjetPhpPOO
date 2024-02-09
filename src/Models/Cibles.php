<?php

namespace App\Models;

use App\Models\HumainofKgb;

class Cibles extends HumainofKgb{

    protected $idname = 'cible_id';
    protected $table = 'CIBLES';
    private $cible_id; 
    private $codename;

    public function getCodeName() : string
    {
        return $this->codename;
    }

    public function getHumainKgbInfo() : HumainofKgb
    {
        $result = $this->query(
            "
            SELECT hk.* FROM HUMAINOFKGB hk
            INNER JOIN CIBLES c ON c.humainkgb_id = hk.humainkgb_id
            WHERE c.cible_id = ?
            ",
            [$this->cible_id],
            true,
            get_class(new HumainofKgb($this->db))
        );

        return $result;
    }

}