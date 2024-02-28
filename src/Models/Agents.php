<?php

namespace App\Models;

use App\Models\HumainofKgb;
use DateTime;

class Agents extends HumainofKgb{

    protected $table = 'agents';
    protected $idname = 'agent_id';
    public $agent_id;
    private $codeofidentification;

    public function getCode()
    {
        return $this->codeofidentification;
    }

    public function getId() : int
    {
        return $this->agent_id;
    }

    public function getSpeciality() : array
    {
        return $this->query(
            "
            SELECT s.* FROM SPECIALITYS s
            INNER JOIN SPECIALITYOFAGENTS sp ON sp.speciality = s.speciality_id
            INNER JOIN AGENTS a ON sp.agent = a.agent_id
            WHERE a.agent_id = ?
            ", 
            [$this->agent_id],
            null,
            get_class(new Specialitys($this->db))
        );
    }

    public function getMissions() : array
    {
        return $this->query(
            "
            SELECT m.* FROM MISSIONS m
            INNER JOIN AGENTSOFMISSIONS am ON am.mission = m.mission_id
            INNER JOIN AGENTS a ON am.agent = a.agent_id
            WHERE a.agent_id = ?
            ",
            [$this->agent_id],
            null,
            get_class(new Missions($this->db))
        );
    }

    public function getHumainKgbInfo() : HumainofKgb
    {
        $result = $this->query(
            "
            SELECT hk.* FROM HUMAINOFKGB hk
            INNER JOIN AGENTS a ON a.humainkgb_id = hk.humainkgb_id
            WHERE a.agent_id = ?
            ",
            [$this->agent_id],
            true,
            get_class(new HumainofKgb($this->db))
        );

        return $result;
    }

    public function create(array $data, ?array $relations = null, ?array $dataHumain = null, ?array $dataHkgb = null) : bool
    {
        $hkgb =  new HumainofKgb($this->db);

        $result = $hkgb->create($dataHkgb,null,$dataHumain);
        //Je recupere hkgb_id pour la creation un nouvel agent
        $humainkgbid = $this->db->getPDO()->lastInsertId();
        //Je met a jour le tableau de donnee des agents
        $data['humainkgb_id'] = $humainkgbid;
        //Je cree le nouvel agent 
        $result &= parent::create($data);
        //Je recupere l'id de l'agent crée
        $agentId = $this->db->getPDO()->lastInsertId();
        //Je mets a jour les données des missions et des spécialité selectionnee pour l agent créé
        foreach($relations['mission_id'] as $missionId){
            $result &= $this->query("INSERT INTO AGENTSOFMISSIONS(agent,mission) VALUES (?,?)",[$agentId,$missionId]);
        }
        foreach($relations['speciality_id'] as $specialityId){
            $result &= $this->query("INSERT INTO SPECIALITYOFAGENTS(agent,speciality) VALUES (?,?)",[$agentId,$specialityId]);
        }

        return $result;
    }

    public function update(int $id, array $data, ?array $donneeHkgb = null, ?array $donneeHumain = null, ?array $relations = null) : bool
    {
        $result = parent::update($id,$data);

        $agent = (new Agents($this->db))->findById($id);
        $humainkgb = new HumainofKgb($this->db);

        $result &= $humainkgb->update($agent->getHumainKgbInfo()->getId(), $donneeHkgb, $donneeHumain);

        //Inserttion des missions selectionné (mission_id et agent_id dans la table AGENTSOFMISSIONS)
        $result &= $this->query("DELETE FROM AGENTSOFMISSIONS WHERE agent = ?",[$id]);
        foreach($relations['mission_id'] as $missionId){
            $result &= $this->query("INSERT INTO AGENTSOFMISSIONS(agent,mission) VALUES (?,?)",[$id,$missionId]);
        }

        //Insertion des specialite selectionné (speciality_id et agent_id dans la table SPECIALITYOFAGENTS)
        $result &= $this->query("DELETE FROM SPECIALITYOFAGENTS WHERE agent = ?",[$id]);
        foreach($relations['speciality_id'] as $specialityId){
            $result &= $this->query("INSERT INTO SPECIALITYOFAGENTS(agent,speciality) VALUES (?,?)",[$id,$specialityId]);
        }

        if($result){
            return true;
        }

        return $result;
    }

    public function destroy(int $id, ?int $humainkgbId = null): bool
    {
        //Suppression des données reliant l'agent et les différentes missions et specialités
        $result = $this->query("DELETE FROM AGENTSOFMISSIONS WHERE agent = ?", [$id]);
        $result &= $this->query("DELETE FROM SPECIALITYOFAGENTS WHERE agent = ?", [$id]);
        //Suppression des données dans la table Agent
        $result &= parent::destroy($id);
        //Je recupere les id pour la suppression
        $humainkgb = new HumainofKgb($this->db);
        $humainkgb = $humainkgb->findById($humainkgbId);
        $humainId = $humainkgb->getHumain()->getId();
        //Suppression des données dans la table HumainKgb et dans la Table Humain
        $result &= $humainkgb->destroy($humainkgbId, $humainId);

        return $result;
    }

    public function findByNationality(int $idpays)
    {
        return $this->query(
            "
            SELECT a.* FROM AGENTS a
            INNER JOIN HUMAINOFKGB hk ON a.humainkgb_id = hk.humainkgb_id
            WHERE hk.nationality_id = ?
            ",
            [$idpays]);
    }

    public function findByName(string $name)
    {
        return $this->query(
            "
            SELECT a.* FROM AGENTS a
            INNER JOIN HUMAINOFKGB hk ON a.humainkgb_id = hk.humainkgb_id
            INNER JOIN HUMAIN h ON h.humain_id = hk.humain_id
            WHERE h.lastname LIKE ?
            OR h.firstname LIKE ?
            ",
            [$name.'%',$name.'%']
        );
    }
}