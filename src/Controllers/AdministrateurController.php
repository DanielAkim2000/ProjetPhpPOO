<?php 

namespace App\Controllers;

use App\Models\Administrateurs;
use App\Validation\Validator;

class AdministrateurController extends Controller {

    public function login()
    {
        // Ce petit bout de code me permettra de me rediriger vers la page d'accueil si un utilisateur deja connecter essayerai de se rendre sur la page login
        $result = isset($_SESSION['auth'])? (($_SESSION['auth'])? true : false ) : false;
        if($result) {
            return header('Location: /ECF');
        }

        return $this->view('Admin.login');
    }

    public function loginPosted()
    {
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'email' => ['required', 'min:3'],
            'password' => ['required']
        ]);

        if ($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /ECF/Login');
            exit;
        }
        $admin = new Administrateurs($this->getDB());
        $admin = $admin->getByEmail($_POST['email']);

        if($admin){

            if(password_verify($_POST['password'], $admin->getPassword()))
            {
                $_SESSION['auth'] = $admin->getId();
                return header('Location: /ECF');
            }
            else{
                return header('Location: /ECF/Login');
            }

        }else{
            return  header('Location: /ECF/Login');
        }
        
    }

    public function logout()
    {
        session_destroy();

        return header('Location: /ECF/Login');
    }
}