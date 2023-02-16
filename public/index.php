<?php
require_once '../vendor/autoload.php';
require("../backend/index.php");
use Cisco\Shadow\Controllers\Admin;
use Cisco\Shadow\Controllers\Trajet;
use Cisco\Shadow\ORM\ORM;
use Cisco\Shadow\Request\User;
use Cisco\Shadow\View;

$db = new ORM();

$router = new View();

$router->get("/", function () {
    echo "test";
});
$router->get("/admin",Admin::class . "::Index");


$router->get("/login", function () {
    echo "login";
});
$router->get("/trajet", Trajet::class . "::Home");

$router->post("/add-user", User::class . "::addUser");
$router->post("/edit-user", User::class . "::editUser");
$router->post("/add-depart", Trajet::class."::addDepart");
$router->post("/add-dest", Trajet::class . "::addDest");
$router->post("/login", User::class . "::login");
$router->get("/user/set-pwd", function () {

});
$router->post("/user/set-pwd", User::class . "::setPwd");
//$router->get("/passager",function())
$router->get("/logout", function () {
    session_destroy();
    header("Location: /login");
});

$router->HandlerNotFound(function () {
    echo "Not found";
});

$router->run();
