<?php 

namespace Cisco\Shadow\Controllers;

use Cisco\Shadow\Request\Destination;
use Cisco\Shadow\View;

class Trajet extends Destination{
    function addDepart(array $data){
        return $this->createDepart($data);
    }
    function addDest(array $data){
        return $this->addDestination($data);
    }
    function Home(){
        $villes_depart = $this->select("depart", ["*"]);
        $villes_arrive = $this->select("destination", ["*"]);
        View::render("admin/trajet",["title"=>"Admin | Trajets", 
        "villes_depart"=>$villes_depart,
        "villes_arrive"=>$villes_arrive]);
    }
}
