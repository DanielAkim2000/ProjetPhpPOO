<?php 

namespace App\Controllers;
use App\Models\Contacts;

class ContactsController extends Controller{

    public function index()
    {
        $contacts = new Contacts($this->getDB());
        $contacts = $contacts->all();

        return $this->view('Contacts.index',compact('contacs'));
    }
}