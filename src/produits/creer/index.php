<?php
$pageTitle = "Créer Produit";
$root_path = __DIR__;
while (!file_exists($root_path . '/config.php') && $root_path !== '/') {
    $root_path = dirname($root_path);
}

require_once($root_path . "/utils/KeepConnexionService.php");
KeepConnexionService::keepConnexion();

require_once($root_path . "/parts/header.php");
?>

<h1>Créer un produit</h1>
<form action="/handlers/creationProduit.php" method="POST">
    <p>
        <label for="name">
            Nom </br>
            <input type="text" name="name">
        </label>
    </p>
    <p>
        <label for="description">
            Description </br>
            <textarea name="description" cols="30" rows="10"></textarea>
        </label>
    </p>
    <p>
        <label for="price">
            Prix </br>
            <input type="text" name="price">
        </label>
    </p>
    <p>
        <button type="submit">Créer le produit</button>
    </p>
</form>