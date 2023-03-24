<?php
namespace Cisco\Shadow\Controllers;

use Cisco\Shadow\ORM\ORM;
use Cisco\Shadow\View;

class Client extends ORM
{
    public function Index(array $params)
    {

        if (isset($params)&&count($params)!==0) {
            $villes_depart = $this->select("depart", fields: ["*"]);
            $villes_arrive = $this->select("destination",fields:["*"]);
            $getTrajet = $this->select("trajet", ["*"],where:[["leave_ville"=>$params["depart"]],["dest_ville"=>$params["arrive"]]], include :["depart" => "id_depart", "destination" => "id_dest"]);

            View::render("client/index", ["title" => "Travel", "villes_depart" => $villes_depart, "trajets" => $getTrajet,
                "villes_arrive" => $villes_arrive]);

        } else {
            $villes_depart = $this->select("depart", ["*"]);
            $villes_arrive = $this->select("destination", ["*"]);
            $getTrajet = $this->select("trajet", ["*"], include :["depart" => "id_depart", "destination" => "id_dest"]);

            View::render("client/index", ["title" => "Travel", "villes_depart" => $villes_depart, "trajets" => $getTrajet,
                "villes_arrive" => $villes_arrive]);

        }

    }

}
