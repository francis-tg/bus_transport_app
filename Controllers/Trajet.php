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
        View::render("admin/trajet");
    }
}
