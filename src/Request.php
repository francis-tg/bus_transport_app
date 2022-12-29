<?php
namespace Cisco\Shadow;
use Cisco\Shadow\ORM\ORM;

class Request extends ORM
{
    function addUser($user){
        extract($_POST);
        var_dump($user["nom"]);
    }
}