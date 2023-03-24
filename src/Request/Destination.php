<?php
namespace Cisco\Shadow\Request;

use Cisco\Shadow\ORM\ORM;
use Cisco\Shadow\Router;

class Destination extends ORM
{
    public function addDestination(array $data)
    {
        if (isset($data["reached_time"]) && isset($data["dest_ville"])) {
            $this->insert("destination", $data);
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    public function createDepart(array $data)
    {
        if (isset($data["leave_time"]) && isset($data["leave_ville"])) {
            $this->insert("depart", $data);
            Router::redirect(goback:true);

        }

    }
    public function createTrajet(array $data)
    {
        if (isset($data["ville_depart"]) && isset($data["ville_arrive"]) && isset($data["prix"])) {
            extract($data);
            $getDepart = $this->selectOne("depart", ["*"], where:[["leave_ville" => $ville_depart]]);
            $getDest = $this->selectOne("destination", ["*"], where:[["dest_ville" => $ville_arrive]]);
            if (count($getDepart) !== 0 || count($getDest) !== 0) {
                if (isset($getDepart) && isset($getDest)) {
                    $id_depart = $getDepart[0]['id'];
                    $id_dest = $getDest[0]['id'];

                    if (!$this->selectOne("trajet", ["*"], [["id_depart" => $id_depart], ["id_dest" => $id_dest]])) {
                        $this->insert("trajet", [
                            "id_depart" => $id_depart,
                            "id_dest" => $id_dest,
                            "prix" => $prix,
                        ]);
                    }
                    Router::redirect(goback:true);
                }

            }else{
                Router::redirect(goback:true);

            }
        }
    }
}
