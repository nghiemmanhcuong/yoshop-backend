<?php

$limit = 14;
$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($curr_page - 1) * $limit;

$sql = "SELECT id,name FROM products LIMIT $limit OFFSET $offset";
$products = query($sql)->fetchAll(PDO::FETCH_ASSOC);

$product_count = query("SELECT * FROM products")->rowCount();
$pages = ceil($product_count / $limit);