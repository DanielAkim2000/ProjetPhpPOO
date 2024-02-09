<?php

namespace App\Models;

use App\Models\HumainofKgb;
use DateTime;

class Agents extends HumainofKgb{

    protected $table = 'agents';
    protected $idname = 'agent_id';
    public $agent_id;
    public $codeofidentification;

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
}