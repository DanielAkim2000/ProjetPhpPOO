<?php

namespace App\Models;

use App\Models\HumainofKgb;

class Contacts extends HumainofKgb{

    protected $idname = 'contact_id';
    protected $table = 'CONTACTS';
    private $contact_id; 
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
            INNER JOIN CONTACTS c ON c.humainkgb_id = hk.humainkgb_id
            WHERE c.contact_id = ?
            ",
            [$this->contact_id],
            true,
            get_class(new HumainofKgb($this->db))
        );

        return $result;
    }

}