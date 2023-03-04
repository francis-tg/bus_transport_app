<?php
namespace Cisco\Shadow\Controllers;
use Cisco\Shadow\flash\Messages;
use Cisco\Shadow\Request\User;
use Cisco\Shadow\Router;
use Cisco\Shadow\View;



class Auth extends User
{
    function login(){
        View::render("login");
    }
    function auth(array $data){
        $this->logUser($data, function ($user) {
            $msg = new Messages();
            if (array_count_values($user) > 0) {
                if (isset($user[0]["password"])) {
                    if ($user[0]["password"] === md5($user["password"])) {
                        $msg->clean();

                        Router::redirect("/admin");
                    } else {
                        
                        # code...
                        $msg->clean();
                        $msg->error("Password wrong");
                        // header("Location: " . $_SERVER["HTTP_REFERER"]);
                        //$msg->clean();
                        Router::redirect(goback: true);
                    }

                } else {
                   $msg->clean();
                    $msg->error("Infomation incorrect pour le compte " . $user['phone']);
                    Router::redirect(goback:true);
                }
            } else {
                $msg->clean();
                $msg->error("Infomation incorrect pour le compte ".$user['phone']);
                Router::redirect(goback:true);


            }

        });
    }
}
