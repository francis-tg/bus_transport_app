<?php

namespace Cisco\Shadow\Controllers;

use Cisco\Shadow\Request\Destination;
use Cisco\Shadow\Router;
use Cisco\Shadow\View;

class Trajet extends Destination
{
    public function addDepart(array $data)
    {
        return $this->createDepart($data);
    }
    public function addDest(array $data)
    {
        return $this->addDestination($data);
    }
    public function Home()
    {

        if (isset($_SESSION["is_admin"]) && isset($_SESSION["user_id"])) {
            $villes_depart = $this->select("depart", ["*"]);
            $villes_arrive = $this->select("destination", ["*"]);
            $getTrajet = $this->select("trajet", ["*"], include :["depart" => "id_depart", "destination" => "id_dest"]);
            View::render("admin/trajet", [
                "title" => "Admin | Trajets",
                "villes_depart" => $villes_depart,
                "villes_arrive" => $villes_arrive,
                "trajets" => $getTrajet,
            ]);
        } else {
            return Router::redirect("/login");
        }

    }
    public function addTrajet(array $data)
    {
        return $this->createTrajet($data);
    }
    public function getTrajet(array $data)
    {

        $getTrajet = $this->select("trajet", ["*"], include :["depart" => "id_depart", "destination" => "id_dest"]);
        return Router::json(200, $getTrajet);

    }

    public function getDepart()
    {
        return printf(json_encode($this->select("depart", ["*"])));

    }
    public function getArrive()
    {
        return printf(json_encode($this->select("destination", ["*"])));
    }
    public function getTrajetById(array $params)
    {
        $trajet = $this->selectOne("trajet", ["leave_ville", "prix", "dest_ville"], [["trajet.id" => $params["id"]]], include :["depart" => "id_depart", "destination" => "id_dest"]);
        return Router::json(200, $trajet);
    }
}
