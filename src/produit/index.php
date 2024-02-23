<?php
$root_path = __DIR__;
while (!file_exists($root_path . '/config.php') && $root_path !== '/') {
    $root_path = dirname($root_path);
}

require($root_path . "/models/Product.php");

$id = $_GET['id'];
$produit = Product::getProductById(intval($id));
if (!empty($produit)) {
    $produitEntity = new Product();
    $produitEntity->setName($produit[0]['name'])->setDescription($produit[0]['description'])->setPrice($produit[0]['price'])->setId($produit[0]['id']);
    $pageTitle = $produitEntity->getName();
}
require_once($root_path . "/parts/header.php");
?>
<h1><?= $produitEntity->getName() ?></h1>
<p><?= $produitEntity->getDescription() ?></p>
<p><?= $produitEntity->getPrice() ?></p>
<p>
<form action="/handlers/acheter.php" method="POST">
    <input type="text" name="product_id" value="<?= $produitEntity->getId() ?>" hidden>
    <button type="submit">Acheter</button>
</form>
</p>