<?php 

namespace App\Models;

use App\Models\Abstract\Model;

class Missions extends Model{

    protected $idname = 'mission_id';
    protected $table = 'MISSIONS';

    public $mission_id;
    private $titre;
    private $description;
    private $codename;
    private $pays_id;
    private $type_id;
    private $statut_id;
    private $speciality_id;
    private $enddate;
    private $startdate;

    public function getId() : int
    {
        return $this->mission_id;
    }

    public function getTitre() : string 
    {
        return $this->titre;
    }

    public function getDescription(): string 
    {
        return $this->description;
    }

    public function getCodeName() : string 
    {
        return $this->codename;
    }

    public function getPays() : Pays
    {
        $result = $this->query(
            "
            SELECT p.* FROM PAYS p
            INNER JOIN MISSIONS m ON m.pays_id = p.pays_id
            WHERE m.mission_id = ?
            ",
            [$this->mission_id],
            true,
            get_class(new Pays($this->db))
        );

        return $result;
    }

    public function getStatut() : Statuts
    {
        $result = $this->query(
            "
            SELECT s.* FROM STATUTS s
            INNER JOIN MISSIONS m ON m.statut_id = s.statut_id 
            WHERE m.mission_id = ?
            ",
            [$this->mission_id],
            true,
            get_class(new Statuts($this->db))
        );
        
        return $result;
    }

    public function getType() : Typemission
    {
        $result = $this->query(
            "
            SELECT t.* FROM TYPEMISSION t
            INNER JOIN MISSIONS m ON m.type_id = t.type_id
            WHERE m.mission_id = ?
            ",
            [$this->mission_id],
            true,
            get_class(new Typemission($this->db))
        );

        return $result;
    }

    public function getSpeciality() : Specialitys
    {
        $result = $this->query(
            "
            SELECT s.* FROM SPECIALITYS s
            INNER JOIN MISSIONS m ON m.speciality_id = s.speciality_id
            WHERE m.mission_id = ?
            ",
            [$this->mission_id],
            true,
            get_class(new Specialitys($this->db))
        );

        return $result;
    }

    public function getEndDate() : string 
    {
        return $this->enddate;
    }

    public function getStartDate() : string 
    {
        return $this->startdate;
    }

    public function getAgents() : array
    {
        $result = $this->query(
            "
            SELECT a.* FROM AGENTS a
            INNER JOIN AGENTSOFMISSIONS am ON am.agent = a.agent_id 
            INNER JOIN MISSIONS m ON m.mission_id = am.mission
            WHERE m.mission_id = ?
            ",
            [$this->mission_id],
            null,
            get_class(new Agents($this->db))
        );

        return $result;
    }

    public function getContacts() : array 
    {
        $result = $this->query(
            "
            SELECT c.* FROM CONTACTS c
            INNER JOIN CONTACTOFMISSIONS cm ON cm.contact = c.contact_id
            INNER JOIN MISSIONS m ON m.mission_id = cm.mission
            WHERE m.mission_id = ? 
            ",
            [$this->mission_id],
            null,
            get_class(new Contacts($this->db))
        );

        return $result;
    }

    public function getCibles() : array
    {
        $result = $this->query(
            "
            SELECT c.* FROM CIBLES c
            INNER JOIN CIBLEOFMISSIONS cm ON cm.cible = c.cible_id
            INNER JOIN MISSIONS m ON m.mission_id = cm.mission
            WHERE m.mission_id = ?
            ",
            [$this->mission_id],
            null,
            get_class(new Cibles($this->db))
        );

        return $result;
    }

    public function getPlanques() : array 
    {
        $result = $this->query(
            "
            SELECT p.*  FROM PLANQUES p
            INNER JOIN PLANQUEOFMISSIONS pm ON pm.planque = p.planque_id
            INNER JOIN MISSIONS m ON m.mission_id = pm.mission
            WHERE m.mission_id = ?
            ",
            [$this->getId()],
            null,
            get_class(new Planques($this->db))
        );

        return $result;
    }

    public function create(array $data, $relations = null) : bool
    {
        $result = parent::create($data);
        //Je recupere l'id de la mission qui a ete creer
        $missionId = $this->db->getPDO()->lastInsertId();
        //Insertion des agents de la mission dans la table associative
        foreach($relations['agent_id'] as $agentId){
            $result &= $this->query("INSERT INTO AGENTSOFMISSIONS(agent,mission) VALUES (?,?)", [$agentId, $missionId]);
        }
        //Insertion des contacts de la mission dans la table associative
        foreach($relations['contact_id'] as $contactId){
            $result &= $this->query("INSERT INTO CONTACTOFMISSIONS(contact,mission) VALUES (?,?)", [$contactId, $missionId]);
        }
        //Insertion des cibles de la mission dans la table associative
        foreach($relations['cible_id'] as $cibleId){
            $result &= $this->query("INSERT INTO CIBLEOFMISSIONS(cible,mission) VALUES(?,?)", [$cibleId, $missionId]);
        }
        //Insertion des planques de la mission dans la table associative
        foreach($relations['planque_id'] as $planqueId){
            $result &= $this->query("INSERT INTO PLANQUEOFMISSIONS(planque,mission) VALUES(?,?)", [$planqueId, $missionId]);
        }
        
        return $result;
    }

    public function update(int $id, array $data, ?array $relations = null) : bool
    {
        $result = parent::update($id,$data);

        //INSERTION DES DONNÉES DANS LA TABLE AGENTSOFMISSIONS ON COMMENCE PAR LA SUPPRESSION DES ANCIENNES RELATIONS EXISTANTE DANS LA TABLE ASSOCIATIVE PUIS ON MET A JOUR AVEC LES NOUVELLES INFO SELECTIONNÉES
        $result &= $this->query("DELETE FROM AGENTSOFMISSIONS WHERE mission = ?", [$id]);
        foreach($relations['agent_id'] as $agentId){
            $result &= $this->query("INSERT INTO AGENTSOFMISSIONS(agent,mission) VALUES(?,?)",[$agentId, $id]);
        }
        //Mis a jour aussi de la table assiociative CIBLEOFMISSIONS
        $result &= $this->query("DELETE FROM CIBLEOFMISSIONS WHERE mission = ?", [$id]);
        foreach($relations['cible_id'] as $cibleId){
            $result &= $this->query("INSERT INTO CIBLEOFMISSIONS(cible,mission) VALUES(?,?)",[$cibleId, $id]);
        }
        //Mis a jour de la table associative CONTACTOFMISSIONS
        $result &= $this->query("DELETE FROM CONTACTOFMISSIONS WHERE mission = ?", [$id]);
        foreach($relations['contact_id'] as $contactId){
            $result &= $this->query("INSERT INTO CONTACTOFMISSIONS(contact,mission) VALUES(?,?)",[$contactId, $id]);
        }
        //Mis a jour de la table associatiove PLANQUEOFMISSIONS
        $result &= $this->query("DELETE FROM PLANQUEOFMISSIONS WHERE mission = ?", [$id]);
        foreach($relations['planque_id'] as $planqueId){
            $result &= $this->query("INSERT INTO PLANQUEOFMISSIONS(planque,mission) VALUES(?,?)",[$planqueId, $id]);
        }

        return $result;
    }

    public function destroy(int $id) : bool
    {
        //Je commence par supprimer toutes le relations que la missions peut avoir dans les differents tables associative

        //Table associative AGENTSOFMISSIONS
        $result = $this->query("DELETE FROM AGENTSOFMISSIONS WHERE mission=?", [$id]);
        //Table associative CIBLEOFMISSIONS
        $result &= $this->query("DELETE FROM CIBLEOFMISSIONS WHERE mission=?", [$id]);
        //Table associative CONTACTOFMISSIONS
        $result &= $this->query("DELETE FROM CONTACTOFMISSIONS WHERE mission=?", [$id]);
        //Table associative PLANQUEOFMISSIONS
        $result &= $this->query("DELETE FROM PLANQUEOFMISSIONS WHERE mission=?", [$id]);

        //Puis je peux ensuite supprimer la ligne de la mission dans la TABLE MISSIONS grace a la fonction parent::destroy je peux reutiliser la methode destroy avant d'avoir la reecriture dans notre classe missions
        $result &= parent::destroy($id);

        //Ensuite je retourne result qui devrait etre a true si tout c est bien passê
        return $result;
    }

    public function findByType(int $typeId)
    {
        return $this->query(
            "
            SELECT * FROM MISSIONS WHERE type_id = ?
            ",
            [$typeId]
        );
    }

    public function findByName(string $name)
    {
        return $this->query(
            "
            SELECT * FROM MISSIONS WHERE titre LIKE ? OR description LIKE ?
            ",
            [$name.'%',$name.'%']
        );
    }
}