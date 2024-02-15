<?php

namespace App\Models;

use App\Models\HumainofKgb;

class Contacts extends HumainofKgb{

    protected $idname = 'contact_id';
    protected $table = 'CONTACTS';
    private $contact_id; 
    private $codename;

    public function getId() : int
    {
        return $this->contact_id;
    }

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

    public function create(array $data, ?array $relations = null, ?array $dataHumain = null, ?array $dataHkgb = null) : bool
    {
        $hkgb =  new HumainofKgb($this->db);

        $result = $hkgb->create($dataHkgb,null,$dataHumain);
        //Je recupere hkgb_id pour la creation du nouveau contact
        $humainkgbid = $this->db->getPDO()->lastInsertId();
        //Je met a jour le tableau de donnee des contact
        $data['humainkgb_id'] = $humainkgbid;
        //Je cree le nouvel agent 
        $result &= parent::create($data);

        return $result;
    }

    public function update(int $id, array $data, ?array $donneeHkgb = null, ?array $donneeHumain = null) : bool
    {
        parent::update($id,$data);

        $contact = (new Contacts($this->db))->findById($id);
        $humainkgb = new HumainofKgb($this->db);

        $result = $humainkgb->update($contact->getHumainKgbInfo()->getId(), $donneeHkgb, $donneeHumain);

        if($result){
            return true;
        }

        return $result;
    }

    public function destroy(int $id, ?int $humainkgbId = null): bool
    {
        //Suppression des donnees dans la table ayant des relations avec le contact
        $result = $this->query("DELETE FROM CONTACTOFMISSIONS WHERE contact = ?", [$id]);
        //Suppresion des donnée dU contact dans la table CONTACT
        $result &= parent::destroy($id);
        //Je recupere le humainid pour la suppression dans les table HUMAINKGB et HUMAIN
        $humainkgb = new HumainofKgb($this->db);
        $humainkgb = $humainkgb->findById($humainkgbId);
        $humainId = $humainkgb->getHumain()->getId();
        //Suppression des données donnes la table HUMAINOFKGB et HUMAIN
        $result &= $humainkgb->destroy($humainkgbId,$humainId);

        return $result;
    }

}