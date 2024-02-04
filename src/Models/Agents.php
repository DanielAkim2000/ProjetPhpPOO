<?php

namespace App\Models;

class Agents extends HumainofKgb{

    private int $agent_id; 

    private string $codeofidentifications;

    private $idname = 'agent_id';

    public function getCodeofId(): string
    {
        return $this->codeofidentifications;
    }
}