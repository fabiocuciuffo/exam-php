<?php
if (isset($_COOKIE['CONNECTED'])) {
    header("Location: /produits");
}
?>
<h1>Inscription</h1>
<form action="/handlers/inscription.php" method="POST">
    <label for="email">
        Email
        <input type="mail" name="email">
    </label>
    <label for="password">
        Mot de passe
        <input type="password" name="password">
    </label>
    <button type="submit">S'inscrire</button>
</form>