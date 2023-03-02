<?php
namespace Cisco\Shadow\Request;
use Cisco\Shadow\ORM\ORM;

class Destination extends ORM
{
    public function addDestination(array $data)
    {
        if (isset($data["reached_time"]) && isset($data["ville"])) {
            $this->insert("destination", $data);
           header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    public function createDepart(array $data){
        if (isset($data["leave_time"]) && isset($data["ville"])) {
        $this->insert("depart", $data);
            header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    }
    public function createTrajet(array $data){
        if(isset($data["ville_depart"])&&isset($data["ville_arrive"])&&isset($data["prix"])){
            extract($data);
            $getDepart = $this->select("depart", ["*"], "ville='$ville_depart'", "id ASC", "1")[0];
            $getDest = $this->select("destination", ["*"], "ville='$ville_arrive'", "id ASC", "1")[0];
            $id_depart = $getDepart['id'];
            $id_dest = $getDest['id'];
            if(count($this->select("trajet",["*"], "id_depart='$id_depart'AND id_dest='$id_dest'"))===0){
                $this->insert("trajet", [
                    "id_depart" => $id_depart,
                    "id_dest" => $id_dest,
                    "prix" => $prix
                ]);
            }
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
}
