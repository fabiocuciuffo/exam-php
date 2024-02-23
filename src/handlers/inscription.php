<?php

$root_path = __DIR__;
while (!file_exists($root_path . '/config.php') && $root_path !== '/') {
    $root_path = dirname($root_path);
}

require($root_path . "/models/User.php");
require($root_path . "/utils/AuthentificationProvider.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo 'Il faut envoyer des données en POST';
    exit();
}

if (empty($_POST["password"]) || empty($_POST["email"])) {
    echo 'Le mail et le password ne peuvent pas être vide';
    exit();
}

$password = $_POST["password"];
$email = $_POST["email"];

$newUser = new User();

$saved = $newUser->setPassword($password)->setEmail($email)->save();
$connected = AuthentificationProvider::checkUser($email, $password);

if ($connected !== false) {
    session_start();
    $_SESSION[$_COOKIE['PHPSESSID']] = $_COOKIE['PHPSESSID'];
    $_SESSION["user-" . $_COOKIE['PHPSESSID']] = $connected;
    header("Location: /produits");
    exit();
} else {
    header("Location: /connexion");
    exit();
}
