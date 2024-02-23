<?php
session_start();
$root_path = __DIR__;
while (!file_exists($root_path . '/config.php') && $root_path !== '/') {
    $root_path = dirname($root_path);
}

require($root_path . "/models/Product.php");

$produitsArr = Product::getAllProducts();

$entityProduits = [];
if (!empty($produitsArr)) {
    foreach ($produitsArr as $value) {
        $produit = new Product();
        $produit->setName($value["name"])->setDescription($value["description"])->setPrice($value['price'])->setId($value['id']);
        $entityProduits[] = $produit;
    }
}
?>
<h1>Produits</h1>
<?php if (isset($_SESSION["user-" . $_COOKIE['PHPSESSID']])) : ?>
    <a href="/commandes/">Toutes les commandes</a>
<?php endif; ?>
<?php if (!empty($entityProduits)) :
    foreach ($entityProduits as $produit) : ?>
        <div>
            <h2><?= $produit->getName() ?></h2>
            <p><?= $produit->getDescription() ?></p>
            <p><?= $produit->getPrice() ?></p>
            <a href="<?= "/produit?id=" . $produit->getId() ?>">Voir le détail</a>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <div>
        <h2>Aucun produit disponible.</h2>
    </div>
<?php endif; ?>