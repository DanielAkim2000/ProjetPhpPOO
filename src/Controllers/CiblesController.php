<?php 

namespace App\Controllers;

use App\Models\Cibles;

class CiblesController extends Controller{

    function index()
    {
        $cibles = new Cibles($this->getDB());
        $cibles = $cibles->all();
        
        return $this->view('Cibles.index',compact('cibles'));
    }
}