<?php 

namespace App\Controllers;
use App\Models\Contacts;
use App\Models\Pays;
use App\Validation\Validator;

class ContactsController extends Controller {

    public function index(int $page)
    {
        $this->isAdmin();

        $contacts = new Contacts($this->getDB());
        $pays = new Pays($this->getDB());
        $dataarray = $contacts->getElementsForPage($page);
        //Dans $dataarray[0] on recupere le nombre de page
        $nbPage = $dataarray[0];
        //Et ici on recupere les données a afficher
        $contacts = $dataarray[1];
        $dataForFiltre = $pays->all();

        return $this->view('Contacts.index',compact('contacts', 'nbPage', 'page', 'dataForFiltre'));
    }

    public function create()
    {
        $this->isAdmin();

        $pays = new Pays($this->getDB());

        $pays = $pays->all();

        return $this->view('Contacts.form', compact('pays'));
    }

    public function created()
    {
        $this->isAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate(
            [
                'codename' => ['required','notinjection','max:20'],
                'firstname' => ['required','notinjection', 'max:20'],
                'lastname' => ['required' ,'notinjection', 'max:20'],
                'nationality_id' => ['required', 'notinjection', 'max:3'],
                'birthday' => ['required', 'notinjection', 'max:11']
            ]
        );
        if($errors){
            $_SESSION['errors'] = $errors;
            return header('Location: /ECF/Contacts/Create');
        }

        $contact = new Contacts($this->getDB());
        $dataContact = array_slice($_POST,0,1);
        $dataHumain = array_slice($_POST, 1,2);
        $dataHkgb = array_slice($_POST,3,2);

        $result = $contact->create($dataContact,null,$dataHumain,$dataHkgb);

        if($result){
            return header('Location: /ECF/Contacts/1 ');
        }
    }

    public function edit($id)
    {
        $this->isAdmin();

        $pays = new Pays($this->getDB());
        $contact = new Contacts($this->getDB());

        $pays = $pays->all();
        $contact = $contact->findById($id);

        return $this->view('Contacts.form', compact('pays', 'contact'));
    }

    public function update($id)
    {
        $this->isAdmin();
        $this->haveToken();

        $_SESSION['errors'] = [];

        $validator = new Validator($_POST);
        $errors = $validator->validate(
            [
                'codename' => ['required','notinjection','max:20'],
                'firstname' => ['required','notinjection', 'max:20'],
                'lastname' => ['required' ,'notinjection', 'max:20'],
                'nationality_id' => ['required', 'notinjection', 'max:3'],
                'birthday' => ['required', 'notinjection', 'max:11']
            ]
        );
        if($errors){
            $_SESSION['errors'] = $errors;
            return header('Location: /ECF/Contacts/Create');
        }

        $contact = new Contacts($this->getDB());
        
        $dataContact = array_slice($_POST,0,1);
        $dataHumain = array_slice($_POST, 1,2);
        $dataHkgb = array_slice($_POST,3,2);
        
        $result = $contact->update($id,$dataContact,$dataHkgb,$dataHumain);

        if($result){
            return header('Location: /ECF/Contacts/1 ');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();
        $this->haveToken();

        $contact =  new Contacts($this->db);
        $contact = $contact->findById($id);

        $humainkgbId = $contact->getHumainKgbInfo()->getId();

        $result = $contact->destroy($id,$humainkgbId);

        if($result){
            return header('Location: /ECF/Contacts/1');
        }
    }

    public function filtre(int $idpays)
    {
        $this->isAdmin();
        
        $contacts = new Contacts($this->getDB());
        $contacts = $contacts->findByNationality($idpays);

        return $this->viewRender('Contacts.table', compact('contacts'));
    }

    public function recherche()
    {
        $this->isAdmin();

        $name = $_POST['nom'];
        $contacts = new Contacts($this->getDB());
        $contacts = $contacts->findByName($name);

        return $this->viewRender('Contacts.table', compact('contacts'));
    }
}