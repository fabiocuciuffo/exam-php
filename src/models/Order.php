<?php

global $root_path;
require_once($root_path . "/config/db.php");

class Order
{

    protected $TABLE_NAME = "order";
    protected int $id;
    protected int $product_id;
    protected int $user_id;

    public function __construct()
    {
        return $this;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setProductId(int $product_id): self
    {
        $this->product_id = $product_id;
        return $this;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public static function getAllOrdersFromUser($user_id)
    {
        global $dsn, $db_user, $db_pass;
        $dbh = new PDO($dsn, $db_user, $db_pass);

        $stmt = $dbh->prepare("SELECT * FROM `order` WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $user_id);
        try {
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function getOrderById(int $id)
    {
        global $dsn, $db_user, $db_pass;
        $dbh = new PDO($dsn, $db_user, $db_pass);

        $stmt = $dbh->prepare("SELECT * FROM `order` WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        try {
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function save()
    {
        global $dsn, $db_user, $db_pass;
        $dbh = new PDO($dsn, $db_user, $db_pass);

        $stmt = $dbh->prepare("INSERT INTO `order` (user_id, product_id) VALUES (:user_id, :product_id)");
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_STR);
        $stmt->bindParam(':product_id', $this->product_id, PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e;
        }
    }
}
