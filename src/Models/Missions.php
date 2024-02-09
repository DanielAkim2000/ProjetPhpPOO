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
            SELECT p.name FROM PAYS p
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
            SELECT s.statut FROM STATUTS s
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
            SELECT t.description FROM TYPEMISSION t
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
}