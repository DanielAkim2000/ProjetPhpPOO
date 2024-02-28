<?php 

namespace App\Controllers;

use Database\DBConnection;

abstract class Controller{
    
    protected $db;

    public function __construct(DBConnection $db) 
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $this->db = $db;
    }
    public function view(string $path, array $params = null)
    {
        ob_start();
        $path = str_replace('.',DIRECTORY_SEPARATOR, $path);
        require VIEWS. $path. '.php';
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }

    protected function getDB()
    {
        return $this->db;
    }

    protected function isAdmin()
    {
        if(isset($_SESSION['roles'])){
            if(in_array("ADMIN", $_SESSION['roles']) || in_array("SUPERADMIN", $_SESSION['roles'])){
                return true;
            } 
        }
        else {
            return header('Location: /ECF/Login');
        }
    }

    protected function isSuperAdmin()
    {
        if(isset($_SESSION['roles'])){
            if(in_array("SUPERADMIN",$_SESSION['roles'])){
                return true;
            } else {
                return header('Location: /ECF');
            }
        } else {
            return header('Location: /ECF');
        }
    }

    protected function haveToken()
    {
        if(isset($_SESSION['token'])){
            if($_SESSION['token'] === $_GET['token']){
                return true;
            } else {
                return header('Location: /ECF');
            }
        }
        else{
            return header('Location: /ECF');
        }
    }

    public function nbPage(int $cpt)
    {
        $nbElementsParPage = 5;
        $nbpage = ceil($cpt/$nbElementsParPage);
        return $nbpage;
    }

    public function viewRender(string $path, array $params = null)
    {
        $path = str_replace('.',DIRECTORY_SEPARATOR, $path);
        require VIEWS. $path. '.php';
    }
}
