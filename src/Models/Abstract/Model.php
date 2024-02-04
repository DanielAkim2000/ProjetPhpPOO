<?php 

namespace App\Models\Abstract;

use Database\DBConnection;
use PDO;

//Model generique pour les model que je créerai
abstract class Model{

    protected $db;
    protected $table;

    protected $idname;

    public function __construct(DBConnection $db) 
    {
        $this->db = $db;
    }

    public function all() : array
    {
        $stmt = $this->db->getPDO()->query("SELECT * FROM {$this->table}");
        $stmt->setFetchMode(PDO::FETCH_CLASS,get_class($this),[$this->db]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function findById($id): Model
    {
        $stmt = $this->db->getPDO()->prepare("SELECT * FROM {$this->table} WHERE {$this->idname} = ?");
        $stmt->setFetchMode(PDO::FETCH_CLASS,get_class($this),[$this->db]);
        $stmt->execute([$id]);
        $pays = $stmt->fetch();
        return $pays;
    }
}