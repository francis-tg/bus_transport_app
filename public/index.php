<?php
use Cisco\Shadow\Controllers\Auth;
use Cisco\Shadow\Controllers\Client;
use Cisco\Shadow\dotenv\Env;
use Cisco\Shadow\Request\User;
require_once '../vendor/autoload.php';
require("../backend/index.php");
use Cisco\Shadow\Controllers\Admin;
use Cisco\Shadow\Controllers\Trajet;
use Cisco\Shadow\ORM\ORM;
use Cisco\Shadow\View;
function applyCorsHeaders(string $origin="*")
{
    header("Access-Control-Allow-Origin: $origin");
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Accept,Authorization');
}

applyCorsHeaders("*");
new Env();
$db = new ORM();

$router = new View();

$router->get("/",Client::class."::Index");
$router->get("/admin",Admin::class . "::Index");


$router->get("/login", Auth::class."::login");
$router->get("/trajet", Trajet::class . "::Home");

$router->post("/add-user", User::class . "::addUser");
$router->post("/edit-user", User::class . "::editUser");
$router->post("/api/add-depart", Trajet::class."::addDepart");
$router->post("/api/add-dest", Trajet::class . "::addDest");
$router->post("/api/add-trajet", Trajet::class . "::addTrajet");
$router->get("/api/get-depart", Trajet::class . "::getDepart");
$router->get("/api/get-arrive", Trajet::class . "::getArrive");
$router->get("/api/trajet-all", Trajet::class . "::getTrajet");
$router->get("/api/trajet", Trajet::class . "::getTrajetById");

$router->post("/api/login", Auth::class."::auth");
$router->post("/api/client-login", Auth::class . "::userAuth");
$router->post("/api/check-user", Auth::class . "::checkUser");

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
