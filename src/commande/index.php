<?php
$root_path = __DIR__;
while (!file_exists($root_path . '/config.php') && $root_path !== '/') {
  $root_path = dirname($root_path);
}

require($root_path . "/models/Order.php");
require($root_path . "/models/Product.php");

$id = $_GET['id'];
$order = Order::getOrderById(intval($id));
if (!empty($order)) {
  $orderEntity = new Order();
  $orderEntity->setId($order[0]['id'])->setUserId($order[0]['user_id'])->setProductId($order[0]['product_id']);
  $pageTitle = "Commande n°" . $orderEntity->getId();
}
$produit = Product::getProductById($orderEntity->getProductId());
if (!empty($produit)) {
  $produitEntity = new Product();
  $produitEntity->setName($produit[0]['name'])->setDescription($produit[0]['description'])->setPrice($produit[0]['price'])->setId($produit[0]['id']);
}
require_once($root_path . "/parts/header.php");
?>
<h1><?= "Commande n°" . $orderEntity->getId() ?></h1>
<h2>Contenu :</h2>
<p><?= $produitEntity->getName() ?></p>
<p><?= $produitEntity->getDescription() ?></p>
<p><?= $produitEntity->getPrice() ?></p>