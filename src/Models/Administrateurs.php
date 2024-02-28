<?php 

namespace App\Models;

use App\Models\HumainofKgb;
use DateTime;

class Administrateurs extends Humain{

    protected $idname = 'admin_id';
    protected $table = 'ADMINISTRATEURS';
    private $admin_id;

    private $email;

    private $password;

    private $dateofcreation;

    public function getId() : int
    {
        return $this->admin_id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDateDeCreation() : string
    {
        return $this->dateofcreation;
    }

    public function getByEmail(string $email)
    {
        return $this->query("SELECT * FROM ADMINISTRATEURS WHERE email = ?",[$email],true);
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function getHumain() : Humain
    {
        return $this->query(
            "
            SELECT h.* FROM HUMAIN h
            INNER JOIN ADMINISTRATEURS am ON am.humain_id = h.humain_id
            WHERE am.humain_id = ?
            ",
            [$this->humain_id],
            true,
            get_class(new Humain($this->db))
        );
    }

    public function getRoles()
    {
        return $this->query(
            "
            SELECT r.* FROM ROLES r
            INNER JOIN ADMINROLES ar ON ar.roles = r.roles_id
            INNER JOIN ADMINISTRATEURS am ON ar.admin = am.admin_id
            WHERE am.admin_id = ?
            ",
            [$this->admin_id],
            null,
            get_class(new Roles($this->db))
        );
    }

    public function create(array $dataAdmin, $relations = null,?array $dataHumain = null) : bool
    {
        $humain = new Humain($this->db);

        $result = $humain->create($dataHumain);
        $humainId = $this->db->getPDO()->lastInsertId();

        $dataAdmin['humain_id'] = $humainId;

        $password = $dataAdmin['password'];
        $dataAdmin['password'] = password_hash($password,PASSWORD_BCRYPT);
        $dataAdmin['dateofcreation'] = date("Y-m-d");

        $result &= parent::create($dataAdmin);

        $adminId = $this->db->getPDO()->lastInsertId();

        foreach($relations['roles_id'] as $rolesId){
            $result &= $this->query("INSERT INTO ADMINROLES(admin,roles) VALUES (?,?)",[$adminId,$rolesId]);
        }

        return $result;
    }

    public function update(int $id, array $dataAdmin, ?array $dataHumain = null, ?array $relations = null) : bool
    {
        $result = parent::update($id, $dataAdmin);
        
        $humain = new Humain($this->db);
        $admin = new Administrateurs($this->db);

        $admin = $admin->findById($id);
        $result &= $humain->update($admin->getHumain()->getId(),$dataHumain);

        $result &= $this->query("DELETE FROM ADMINROLES WHERE admin = ?",[$id]);
        foreach($relations['roles_id'] as $rolesId){
            $result &= $this->query("INSERT INTO ADMINROLES(admin,roles) VALUES (?,?)",[$id,$rolesId]);
        }

        return $result;
    }

    public function destroy(int $id) : bool
    {
        $result = $this->query("DELETE FROM ADMINROLES WHERE admin = ?",[$id]);

        $humain = new Humain($this->db);
        $admin = new Administrateurs($this->db);

        $admin = $admin->findById($id);

        $humainId = $admin->getHumain()->getId();

        $result &= parent::destroy($id);
        $result = $humain->destroy($humainId);

        return $result;
    }   
}