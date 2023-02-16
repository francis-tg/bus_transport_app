<?php
namespace Cisco\Shadow\Request;
use Cisco\Shadow\ORM\ORM;

class Destination extends ORM
{
    public function addDestination(array $data)
    {
        if (isset($data["reached_time"]) && isset($data["ville"])) {
            $this->insert("depart", $data);
            print("success");
        }
    }
    public function createDepart(array $data){
        if (isset($data["leave_time"]) && isset($data["ville"])) {
        $this->insert("destination", $data);
        print("success");
    }

    }
}
