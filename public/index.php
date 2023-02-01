<?php
use Cisco\Shadow\ORM\ORM;
use Cisco\Shadow\Page;
use Cisco\Shadow\Request\User;
use Cisco\Shadow\View;

require_once '../vendor/autoload.php';
require("../backend/index.php");

$db = new ORM();


$router = new View();

$router->get("/admin", function () {
    $users = $GLOBALS["db"]->select("user", ["*"]);

    $role = $GLOBALS["db"]->select("role", ["*"]);

    View::render("admin/index",["users"=>$users,"roles"=>$role]);
});
$router->get("/login", function () {
    echo "login";
});
$router->post("/add-user", User::class."::addUser");
$router->post("/edit-user", User::class . "::editUser");
$router->post("/login", User::class . "::login");
$router->get("/user/set-pwd", function () {

});
$router->post("/user/set-pwd",User::class . "::setPwd");
$router->get("/logout", function () {
    session_destroy();
    header("Location: /login");
});

$router->HandlerNotFound(function () {
    echo "Not found";
});
$router->run();

?>
