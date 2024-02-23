<?php
global $root_path;
require_once($root_path . "/config/db.php");

class AuthentificationProvider
{
    public static function checkUser(string $email, string $password)
    {
        global $dsn, $db_user, $db_pass;
        $dbh = new PDO($dsn, $db_user, $db_pass);

        $password = hash('sha384', $password);

        $stmt = $dbh->prepare("SELECT id FROM user WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        $stmt->execute();
        $result = $stmt->fetchAll();
        if (empty($result)) {
            return false;
        }
        if (isset($result[0]['id'])) {
            return $result[0]['id'];
        }
    }
}
