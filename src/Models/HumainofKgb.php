<?php 

namespace App\Models;

use App\Models\Abstract\Model;
use App\Models\Pays;
use DateTime;

class HumainofKgb extends Humain{
    
    protected $table = 'HUMAINOFKGB';
    protected $idname = 'humainkgb_id';
    protected $nationality_id;
    public $name;
    public $birthday;
    public $humainkgb_id;

    public function getId() : int
    {
        return $this->humainkgb_id;
    }
    public function getHumain() : Humain
    {
        return $this->query(
            "
            SELECT h.* FROM HUMAIN h
            INNER JOIN HUMAINOFKGB hk ON hk.humain_id = h.humain_id
            WHERE hk.humainkgb_id = ?
            ",
            [$this->humainkgb_id],
            true,
            get_class(new Humain($this->db))
        );
    }

    public function getNationality() : Pays
    {
        $result = $this->query(
            "
            SELECT p.* FROM PAYS p
            INNER JOIN HUMAINOFKGB h ON h.nationality_id = p.pays_id
            WHERE h.humainkgb_id = ?
            ",
            [$this->humainkgb_id],
            true,get_class(new Pays($this->db))
        );

        return $result;
    }

    public function getBirthday() : string 
    {
        return $this->birthday;
    }

    public function create(array $data,?array $relations = null, ?array $dataHumain = null) : bool
    {
        $humain = new Humain($this->db);

        if(isset($dataHumain['firstname'])){
             //Je cree un nouvel humain
            $result = $humain->create($dataHumain);
            //Je recupere le dernier id
            $humainid = $this->db->getPDO()->lastInsertId();
            //Je l'insere dans les données pour creer Hkgb
            $data['humain_id'] = $humainid;
            //Je cree en suite l'humain du kgb
            $result &= parent::create($data);
        }
        else{
            //Je cree l'humain du kgb
            $result = parent::create($data);     
        }

        return $result; 
    }

    public function update(int $id, array $data ,?array $donneeHumain = null ) :bool 
    {
        if($donneeHumain){
            $result = parent::update($id, $data);

            $humainkgb = $this->findById($id);
            $humain = new Humain($this->db);

            $result &= $humain->update($humainkgb->getHumain()->getId(), $donneeHumain);
        }else {
            $result = parent::update($id, $data);
        }
        

        return $result;

    }

    public function destroy(int $id, ?int $humainId = null): bool
    {
        if($humainId){
            $humain = new Humain($this->db);
            //Suppression des donnees dans la table HUMAINOFKGB
            $result = parent::destroy($id);
            //Suppression des données dans la table HUMAIN
            $result &= $humain->destroy($humainId);
        } else {
            //Utilisation de la methode destroy de Model
            $result = parent::destroy($id);       
        }

        return $result;
    }
}