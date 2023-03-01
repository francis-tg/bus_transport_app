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
}
