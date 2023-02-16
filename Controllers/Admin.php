<?php
namespace Cisco\Shadow\Controllers;
use Cisco\Shadow\ORM\ORM;
use Cisco\Shadow\View;



class Admin extends ORM
{
    function Index(){
        $users =  $this->select("user", ["*"]);

        $role = $this->select("role", ["*"]);

       View::render("admin/index", ["title"=>"Admin","users" => $users, "roles" => $role]);

    }
    
}
