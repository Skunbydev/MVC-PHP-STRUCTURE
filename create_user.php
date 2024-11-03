<?php
require_once 'App/controllers/UserController.php';

$userController = new UserController();

$username = "skunbydev@gmail.com";
$password = "tester";

$userController->create($username, $password);
?>
