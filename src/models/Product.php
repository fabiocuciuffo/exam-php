<?php

global $root_path;
require_once($root_path . "/config/db.php");

class Product
{

    protected $TABLE_NAME = "product";
    protected string $name;
    protected string $description;
    protected float $price;
    protected int $id;

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

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDescription(string $desc): self
    {
        $this->description = $desc;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setPrice(string $price): self
    {
        $this->price = floatval($price);
        return $this;
    }

    public function getPrice(): string
    {
        return strval($this->price);
    }

    public static function getAllProducts()
    {
        global $dsn, $db_user, $db_pass;
        $dbh = new PDO($dsn, $db_user, $db_pass);

        $stmt = $dbh->prepare("SELECT * FROM product");
        try {
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function getProductById(int $id)
    {
        global $dsn, $db_user, $db_pass;
        $dbh = new PDO($dsn, $db_user, $db_pass);

        $stmt = $dbh->prepare("SELECT * FROM product WHERE id = :id");
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

        $stmt = $dbh->prepare("INSERT INTO product (name, description, price) VALUES (:name, :description, :price)");
        $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindParam(':price', $this->price, PDO::PARAM_STR);
        try {
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e;
        }
    }
}
