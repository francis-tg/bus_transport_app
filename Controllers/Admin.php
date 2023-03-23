<?php
namespace Cisco\Shadow\Controllers;
use Cisco\Shadow\ORM\ORM;
use Cisco\Shadow\Router;
use Cisco\Shadow\View;



class Admin extends ORM
{
    function Index(){
       if(isset($_SESSION["is_admin"]) && isset($_SESSION["user_id"])){
         $users =  $this->select("user", ["*"]);

        $role = $this->select("role", ["*"]);

       View::render("admin/index", ["title"=>"Admin","users" => $users, "roles" => $role]);
       }else{
           return Router::redirect("/login");
       }

    }
    function Login(){
        View::render("admin/login");
    }
    
}
