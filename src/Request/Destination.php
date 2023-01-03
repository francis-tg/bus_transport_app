<?php
namespace Cisco\Shadow\Request;
use Cisco\Shadow\ORM\ORM;

class Destination extends ORM
{
    public function addDestionnation($data)
    {
        if (isset($data["reached_time"]) && isset($data["ville"])) {
            $this->insert("user", $data);
            print("success");
        }
    }
}
