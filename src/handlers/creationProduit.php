<?php

session_start();


$root_path = __DIR__;
while (!file_exists($root_path . '/config.php') && $root_path !== '/') {
    $root_path = dirname($root_path);
}

require($root_path . "/utils/KeepConnexionService.php");

KeepConnexionService::keepConnexion();

require($root_path . "/models/Product.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo 'Il faut envoyer des données en POST';
    exit();
}

if (empty($_POST["name"]) || empty($_POST["description"]) || empty($_POST["price"])) {
    echo 'Le name, la description et le prix ne peuvent pas être vide';
    exit();
}

$name = $_POST["name"];
$description = $_POST["description"];
$price = $_POST["price"];

$newUser = new Product();

try {
    $saved = $newUser->setName($name)->setDescription($description)->setPrice($price)->save();
} catch (Exception $e) {
    throw new $e;
}

if ($saved === true) {
    header("Location: /produits");
} else {
    header("Location: /produits/creer/");
}
