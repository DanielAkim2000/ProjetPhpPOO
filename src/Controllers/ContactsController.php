<?php 

namespace App\Controllers;
use App\Models\Contacts;
use App\Models\Pays;

class ContactsController extends Controller {

    public function index()
    {
        $this->isAdmin();

        $contacts = new Contacts($this->getDB());
        $contacts = $contacts->all();

        return $this->view('Contacts.index',compact('contacts'));
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

        $contact = new Contacts($this->getDB());
        $dataContact = array_slice($_POST,0,1);
        $dataHumain = array_slice($_POST, 1,2);
        $dataHkgb = array_slice($_POST,3,2);

        $result = $contact->create($dataContact,null,$dataHumain,$dataHkgb);

        if($result){
            return header('Location: /ECF/Contacts ');
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

        $contact = new Contacts($this->getDB());
        
        $dataContact = array_slice($_POST,0,1);
        $dataHumain = array_slice($_POST, 1,2);
        $dataHkgb = array_slice($_POST,3,2);
        
        $result = $contact->update($id,$dataContact,$dataHkgb,$dataHumain);

        if($result){
            return header('Location: /ECF/Contacts ');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();

        $contact =  new Contacts($this->db);
        $contact = $contact->findById($id);

        $humainkgbId = $contact->getHumainKgbInfo()->getId();

        $result = $contact->destroy($id,$humainkgbId);

        if($result){
            return header('Location: /ECF/Contacts');
        }
    }
}