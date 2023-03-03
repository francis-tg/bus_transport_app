<?php
namespace Cisco\Shadow\Request;

use Cisco\Shadow\Interfaces\UserInterface;
use Cisco\Shadow\ORM\ORM;


class User extends ORM implements UserInterface
{
    public function addUser(array $user)
    {
        
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
    public function logUser(array $user_data, $callback)
    {
        if (isset($user_data["phone"])) {
            $user = $this->select("user", ["*"], "phone="."'".$user_data["phone"]."'");
            return call_user_func_array($callback, [array_merge($user_data,$user)]);
        }
    }
    public function setPwd(array $user_data)
    {
        if (isset($user_data["password"]) && isset($user_data["user_id"])) {
            $this->update("user", ["password" => $user_data["password"]], 'id=$user_data["user_id"]');
        }
    }
}
