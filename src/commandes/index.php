<?php
session_start();
$root_path = __DIR__;
while (!file_exists($root_path . '/config.php') && $root_path !== '/') {
    $root_path = dirname($root_path);
}

require($root_path . "/models/Order.php");
$orders = Order::getAllOrdersFromUser($_SESSION["user-" . $_COOKIE["PHPSESSID"]]);
$ordersEntity = [];
if (!empty($orders)) {
    foreach ($orders as $order) {
        $orderEntity = new Order();
        $ordersEntity[] = $orderEntity->setProductId($order['product_id'])->setUserId($order['user_id'])->setId($order['id']);
    }
}
?>

<h1>Toutes vos commandes :</h1>
<?php if (!empty($ordersEntity)) : ?>
    <?php foreach ($ordersEntity as $order) : ?>
        <a href="/commande?id=<?= $order->getId() ?>">Commande n°<?= $order->getId() ?></a>
    <?php endforeach; ?>
<?php else : ?>
    <h2>Pas de commandes pour le moment.</h2>
<?php endif; ?>