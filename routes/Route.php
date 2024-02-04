<?php

namespace Router;
use Database\DBConnection;

class Route{
    
    public $path;
    public $action;

    public $matches;

    public function __construct($path,$action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }
    /* Methode pour voir si l'url matches*/
    public function matches(string $url)
    {
        $path = preg_replace('#:([\w]+)#', '([^/]+)',$this->path);
        $pathToMatch= "#^$path$#";

        if(preg_match($pathToMatch, $url, $matches)){
            $this->matches = $matches;
            return true;
        }else{
            return false;
        }
    }
    /* Method pour executer l'action demander */
    public function execute()
    {
        /* Cette function me permet de recuperer la method et le controller fournit pas l'attribut action de la class Route ($this->action) */

        $params = explode('@',$this->action);
        $objet= $params[0];
        $controller = new $objet(new DBConnection(DB_NAME,DB_HOST,DB_USERNAME,DB_PASSWORD));
        $method = $params[1];

        return isset($this->matches[1])? $controller->$method($this->matches[1]) : $controller->$method();

    }
}