<?php

$limit = 14;
$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($curr_page - 1) * $limit;

$sql = "SELECT id,surname,name,email,phone,birthday,access,sex FROM users  WHERE access='user' ORDER BY id DESC LIMIT $limit OFFSET $offset";
$customers = query($sql)->fetchAll(PDO::FETCH_ASSOC);

$customer_count = query("SELECT name FROM users WHERE access='user'")->rowCount();
$pages = ceil($customer_count / $limit);