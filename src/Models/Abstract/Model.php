<?php 

namespace App\Models\Abstract;

use ArrayObject;
use Database\DBConnection;
use PDO;
use PhpToken;

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

    public function findById($id)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE {$this->idname} = ?", [$id], true);
    }

    public function nbEnregistrement()
    {
        //PREPARATION DE LA REQUETE
        $stmt =  $this->db->getPDO()->prepare("SELECT COUNT({$this->idname}) as cpt FROM {$this->table}");
        //DESIGNATION DU MODE DE RECUPERATION DES DONNEES
        $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
        $stmt->execute();
        $count = $stmt->fetch();

        return $count;
    }

    public function getElementsForPage(int $page)
    {
        if(empty($page)){
            $page = 1;
        }
        $cpt =(int) $this->nbEnregistrement();
        $nbElementsParPage = 8;
        $nbPage = ceil($cpt/$nbElementsParPage);
        $debut = ($page-1)*$nbElementsParPage;

        $stmt = $this->db->getPDO()->prepare("SELECT * FROM {$this->table} LIMIT ?,?");
        $stmt->bindParam(1,$debut, PDO::PARAM_INT);
        $stmt->bindParam(2,$nbElementsParPage, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS,get_class($this),[$this->db]);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return [$nbPage,$data];
    }

    public function create(array $data, ?array $relations = null) : bool
    {
        $firstParenthesis = "";
        $secondParenthesis = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = ($i === count($data))? " ": ", ";
            $firstParenthesis .= "{$key}{$comma}";
            $secondParenthesis .= ":{$key}{$comma}";
            $i++;
        }

        return $this->query("INSERT INTO {$this->table} ($firstParenthesis) VALUES ($secondParenthesis)",$data);
    }

    public function update(int $id,array $data) : bool
    {
        $sqlRequestPart = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = ($i === count($data))? " ": ", ";
            $sqlRequestPart .= "{$key} = :{$key}{$comma}";
            $i++;
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
            || strpos($sql, 'INSERT') === 0){

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