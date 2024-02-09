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
        return $this->query("SELECT * FROM {$this->table} WHERE {$this->idname} = ?", [$id], true);
    }

    public function update(int $id,array $data) : bool
    {
        $sqlRequestPart = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data)? " ": ", ";
            $sqlRequestPart .= "{$key} = :{$key}{$comma}";
        }

        $data['id'] = $id;

        return $this->query("UPDATE {$this->table} SET {$sqlRequestPart} WHERE {$this->idname} = :id",$data);
    }

    public function destroy(int $id): bool
    {
        return $this->query("DELETE FROM {$this->table} WHERE {$this->idname}=?",[$id]);
    }

    public function query(string $sql,array $param = null,bool $single = null,$classes=null)
    {
        $method = is_null($param) ? 'query' : 'prepare' ;

        if(
            strpos($sql, 'DELETE') === 0 
            || strpos($sql, 'UPDATE') === 0 
            || strpos($sql, 'CREATE') === 0){

            $stmt = $this->db->getPDO()->$method($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS,$classes? $classes : get_class($this),[$this->db]);
            return $stmt->execute($param);
        }

        $fecth = is_null($single) ? 'fetchAll' : 'fetch' ;

        $stmt = $this->db->getPDO()->$method($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS,$classes? $classes : get_class($this),[$this->db]);

        if($method === 'query'){
            return $stmt->$fecth();
        }else{
            $stmt->execute($param);
            return $stmt->$fecth();
        }
    }


}