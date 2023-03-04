<?php
namespace Cisco\Shadow\Controllers;

use Cisco\Shadow\ORM\ORM;
use Cisco\Shadow\View;

class Client extends ORM
{
    public function Index()
    {
        $villes_depart = $this->select("depart", ["*"]);
        $villes_arrive = $this->select("destination", ["*"]);
        View::render("client/index", ["title" => "Travel","villes_depart"=>$villes_depart,
        "villes_arrive"=>$villes_arrive]);

    }

}
