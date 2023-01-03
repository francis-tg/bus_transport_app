<?php
use Cisco\Shadow\Page;
use Cisco\Shadow\Request\User;

require_once '../vendor/autoload.php';
require("../backend/index.php");
use  Cisco\Shadow\Router;

$router = new Router();

$router->get("/", function () {
    Page::view("index");
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

$router->run();

?>
