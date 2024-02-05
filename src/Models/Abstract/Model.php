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
        return $this->query("SELECT * FROM {$this->table}");
        
    }

    public function findById($id): Model
    {
        return $this->query("SELECT * FROM {$this->table} WHERE {$this->idname} = ?", $id, true);
    }

    public function query(string $sql,int $param = null,bool $single = null,$classes=null)
    {
        $method = is_null($param) ? 'query' : 'prepare' ;
        $fecth = is_null($single) ? 'fetchAll' : 'fetch' ;

        $stmt = $this->db->getPDO()->$method($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS,$classes? $classes : get_class($this),[$this->db]);

        if($method === 'query'){
            return $stmt->$fecth();
        }else{
            $stmt->execute([$param]);
            return $stmt->$fecth();
        }
    }
}