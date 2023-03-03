<?php
namespace Cisco\Shadow\Controllers;
use Cisco\Shadow\flash\Messages;
use Cisco\Shadow\Request\User;
use Cisco\Shadow\View;



class Auth extends User
{
    function login(){
        View::render("login");
    }
    function auth(array $data){
        

        $this->logUser($data, function ($user) {
            if (array_count_values($user) > 0) {
                $msg = new Messages();
                if (isset($user[0]["password"])) {
                    if ($user[0]["password"] === md5($user["password"])) {
                        $msg->clean();

                        print("login success");
                    } else {
                        
                        # code...
                        $msg->clean();
                        $msg->error("Password wrong");
                    
                        header("Location: " . $_SERVER["HTTP_REFERER"]);
                        //$msg->clean();
                    }

                } else {
                    var_dump($user);

                    //header("Location:/user/set-password");
                }
            } else {
                print("user not found...");
            }

        });
    }
}
