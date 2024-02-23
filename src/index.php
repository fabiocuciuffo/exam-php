<?php
$root_path = __DIR__;
while (!file_exists($root_path . '/config.php') && $root_path !== '/') {
    $root_path = dirname($root_path);
}

require($root_path . "/utils/KeepConnexionService.php");
KeepConnexionService::keepConnexion();

?>
<h1>Connexion</h1>
<form action="/handlers/connexion.php" method="POST">
    <label for="email">
        Email
        <input type="mail" name="email">
    </label>
    <label for="password">
        Mot de passe
        <input type="password" name="password">
    </label>
    <button type="submit">Connexion</button>
</form>
<a href="/inscription">Inscription</a>