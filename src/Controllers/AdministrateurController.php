<?php 

namespace App\Controllers;

use App\Models\Administrateurs;
use App\Models\Roles;
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
            'email' => ['required', 'min:8', 'notinjection'],
            'password' => ['required', 'min:4', 'notinjection'],
        ]);
        if ($errors){
            $_SESSION['errors'] = $errors;
            header('Location: /ECF/Login');

            exit;
        }
        $admin = new Administrateurs($this->getDB());
        $admin = $admin->getByEmail($_POST['email']);

        if($admin){

            if(password_verify($_POST['password'], $admin->getPassword()))
            {
                $_SESSION['auth'] = $admin->getId();
                foreach($admin->getRoles() as $roles){
                    $_SESSION['roles'][] = $roles->getName();
                }
                $_SESSION['token'] = md5(time() * rand(15,150));
    
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

    public function index(int $page)
    {
        $this->isSuperAdmin();
        $admins = new Administrateurs($this->getDB());
        $dataarray = $admins->getElementsForPage($page);
        //Dans $dataarray[0] on recupere le nombre de page
        $nbPage = $dataarray[0];
        //Et ici on recupere les données a afficher
        $admins = $dataarray[1];

        return $this->view('Admin.index', compact('admins','nbPage', 'page'));
    }

    public function edit(int $id)
    {
        $this->isSuperAdmin();

        $admin = new Administrateurs($this->getDB());
        $roles = new Roles($this->getDB());
        
        $roles = $roles->all();
        $admin = $admin->findById($id);

        return $this->view('Admin.form', compact('admin','roles'));
    }

    public function create()
    {
        $this->isSuperAdmin();

        $roles = new Roles($this->getDB());
        
        $roles = $roles->all();

        return $this->view('Admin.form', compact('roles'));
    }

    public function update(int $id)
    {
        $this->isSuperAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'email' => ['required', 'min:8', 'notinjection'],
            'firstname' => ['required', 'max:20', 'notinjection'],
            'lastname' => ['required', 'max:20', 'notinjection'],
            'roles_id[]' => ['required', 'max:10', 'notinjection']
        ]);
        if ($errors){
            $_SESSION['errors'] = $errors;
            header('Location: /ECF/Admin/Edit/'.$id);
            exit;
        }
        

        $admin = new Administrateurs($this->getDB());

        $dataHumain = array_slice($_POST,0,2);
        $dataAdmin = array_slice($_POST,2,1);
        $relations = array_slice($_POST,3,1);

        
        $result = $admin->update($id,$dataAdmin,$dataHumain,$relations);

        if($result){
            return header('Location: /ECF/Admin/1');
        }
    }

    public function created()
    {
        $this->isSuperAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'email' => ['required', 'min:8', 'notinjection'],
            'firstname' => ['required', 'max:20', 'notinjection'],
            'lastname' => ['required', 'max:20', 'notinjection'],
            'roles_id[]' => ['required', 'max:10', 'notinjection']
        ]);
        if ($errors){
            $_SESSION['errors'] = $errors;
            header('Location: /ECF/Admin/Create/');
            exit;
        }

        $admin = new Administrateurs($this->getDB());

        $dataHumain = array_slice($_POST,0,2);
        $dataAdmin = array_slice($_POST,2,2);
        $relations = array_slice($_POST,4,1);

        $result = $admin->create($dataAdmin,$relations,$dataHumain);

        if($result){
            return header('Location: /ECF/Admin/1');
        }
    }

    public function destroy(int $id)
    {
        $this->isSuperAdmin();
        $this->haveToken();

        $admin = new Administrateurs($this->getDB());

        $result = $admin->destroy($id);

        if($result){
            return header('Location: /ECF/Admin/1');
        }
    }
}