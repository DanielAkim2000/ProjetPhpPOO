<?php

namespace App\Models;

use App\Models\HumainofKgb;

class Cibles extends HumainofKgb{

    protected $idname = 'cible_id';
    protected $table = 'CIBLES';
    private $cible_id; 
    private $codename;

    public function getId() : int
    {
        return $this->cible_id;
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
            INNER JOIN CIBLES c ON c.humainkgb_id = hk.humainkgb_id
            WHERE c.cible_id = ?
            ",
            [$this->cible_id],
            true,
            get_class(new HumainofKgb($this->db))
        );

        return $result;
    }

    public function create(array $data, ?array $relations = null, ?array $dataHumain = null, ?array $dataHkgb = null) : bool
    {
        $hkgb =  new HumainofKgb($this->db);

        $result = $hkgb->create($dataHkgb,null,$dataHumain);
        //Je recupere hkgb_id pour la creation de la nouvelle cible
        $humainkgbid = $this->db->getPDO()->lastInsertId();
        //Je met a jour le tableau de donnee de la cibles
        $data['humainkgb_id'] = $humainkgbid;
        //Je cree le nouvel cible 
        $result &= parent::create($data);

        return $result;
    }

    public function update(int $id, array $data, ?array $donneeHkgb = null, ?array $donneeHumain = null) : bool
    {
        parent::update($id,$data);

        $cible = (new Cibles($this->db))->findById($id);
        $humainkgb = new HumainofKgb($this->db);

        $result = $humainkgb->update($cible->getHumainKgbInfo()->getId(), $donneeHkgb, $donneeHumain);

        if($result){
            return true;
        }

        return $result;
    }

    public function destroy(int $id, ?int $humainkgbId = null): bool
    {
        //Suppression des donnees dans la table ayant des relations avec la cible
        $result = $this->query("DELETE FROM CIBLEOFMISSIONS WHERE cible = ?", [$id]);
        //Suppresion des donnée de la cible dans la table cible
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