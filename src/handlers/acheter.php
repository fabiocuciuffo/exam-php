<?php


$root_path = __DIR__;
while (!file_exists($root_path . '/config.php') && $root_path !== '/') {
  $root_path = dirname($root_path);
}

require($root_path . "/utils/KeepConnexionService.php");

KeepConnexionService::keepConnexion();

require($root_path . "/models/Order.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  echo 'Il faut envoyer des données en POST';
  exit();
}

if (empty($_POST["product_id"])) {
  echo 'Le product_id ne peut être vide.';
  exit();
}

$product_id = $_POST["product_id"];
$user_id = $_SESSION["user-" . $_COOKIE['PHPSESSID']];

$newOrder = new Order();

try {
  $saved = $newOrder->setProductId($product_id)->setUserId($user_id)->save();
} catch (Exception $e) {
  throw new $e;
}

if ($saved === true) {
  header("Location: /commandes/");
} else {
  header("Location: /produits/");
}
