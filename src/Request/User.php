<?php
namespace Cisco\Shadow\Request;

use Cisco\Shadow\Interfaces\UserInterface;
use Cisco\Shadow\ORM\ORM;


class User extends ORM implements UserInterface
{
    public function addUser(array $user)
    {
        print_r($user);
        if (isset($user["nom"]) && isset($user["prenom"]) && isset($user["id_role"])) {
            $user["password"] = md5($user["password"]);
            $this->insert("user", $user);
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    public function editUser(array $user)
    {
        if (isset($user["nom"]) && isset($user["prenom"]) && isset($user["phone"])) {
            print_r($user);
            $this->update("user", [
                "nom"=>$user["nom"],
                "prenom"=>$user["prenom"],
                "phone"=>$user["phone"]
            ],'id='.$user["user_id"]);
            header("Location: " . $_SERVER["HTTP_REFERER"]);

        }

    }
    public function deleteUser(array $user)
    {
        if(isset($user["id"])){
            extract($user);
            $this->delete("user", "id=" . $id);
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    public function login(array $user_data)
    {
        if (isset($user_data["phone"])) {
            $user = $this->select("user", "*", ["phone" => $user_data["phone"]]);
            if (array_count_values($user) > 0) {
                if (isset($user_data["password"])) {
                    if ($user_data["password"] === md5($user_data["password"])) {
                        print("login successful");
                    } else {
                        # code...
                        print("password wrong");
                    }

                } else {
                    header("Location:/user/set-password");
                }
            } else {
                print("user not found...");
            }

        }
    }
    public function setPwd(array $user_data)
    {
        if (isset($user_data["password"]) && isset($user_data["user_id"])) {
            $this->update("user", ["password" => $user_data["password"]], 'id=$user_data["user_id"]');
        }
    }
}
