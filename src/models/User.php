<?php

global $root_path;
require_once($root_path . "/config/db.php");

class User
{

    protected $TABLE_NAME = "user";
    protected $email;
    protected $password;

    public function __construct()
    {
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = hash('sha384', $password);
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function save()
    {
        global $dsn, $db_user, $db_pass;
        $dbh = new PDO($dsn, $db_user, $db_pass);

        $stmt = $dbh->prepare("INSERT INTO user (email, password) VALUES (:email, :password)");
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $this->password, PDO::PARAM_STR);
        try {
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e;
        }
    }
}
