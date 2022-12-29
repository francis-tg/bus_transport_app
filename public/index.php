<?php
use Cisco\Shadow\Request;
require_once '../vendor/autoload.php';
require("../backend/index.php");
use  Cisco\Shadow\Router;

$router = new Router();

$router->get("/", function () {

});
$router->get("/login", function () {
    echo "login";
});
$router->post("/add-user", Request::class."::AddUser");

$router->run();

?>
