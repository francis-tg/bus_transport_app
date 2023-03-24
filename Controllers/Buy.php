<?php
use Cisco\Shadow\ORM\ORM;
use Cisco\Shadow\Router;
use Cisco\Shadow\View;

class Buy extends ORM{
    function Main(array $params){
        if (isset($_SESSION["user_id"])) {
            View::render("client/payout");
        }else{
            Router::redirect("/login");
        }
    }
}