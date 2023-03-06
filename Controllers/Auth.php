<?php
namespace Cisco\Shadow\Controllers;
use Cisco\Shadow\crypto\Hash;
use Cisco\Shadow\dotenv\Env;
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
    function userAuth(array $data){
        extract($data);
        if(isset($username) && !empty($username) && isset($password) && !empty($password)){
            $user = $this->selectOne("user", ["nom","phone","nom_role"],[["phone"=>$username],["nom_role"=>"client"],["password"=>md5($password)]],include:["role"=>"id_role"]);
            if(!$user || !isset($user)){
                Router::json(401, "Information incorrect");
            }else{
                $token = Hash::Cipher($user["phone"], $_ENV["secret"]);

                Router::json(200, [["token"=>$token],$user]);
            }
        }
        else{
            Router::send(400, "Veuillez renseigner les champs...");
        }

    }
    function checkUser($data){
        $token = $data["token"];
        !Hash::VerifyCipher($token, $_ENV["secret"])?Router::send("401","Non authorisé"):Router::send(200,"connect");
    }
}
