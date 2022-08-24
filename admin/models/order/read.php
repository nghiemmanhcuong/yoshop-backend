<?php


$limit = 13;
$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($curr_page - 1) * $limit;

$sql = "SELECT * FROM orders ORDER BY id DESC LIMIT $limit OFFSET $offset";
$orders = query($sql)->fetchAll(PDO::FETCH_ASSOC);

$order_count = query("SELECT * FROM orders")->rowCount();
$pages = ceil($order_count / $limit);