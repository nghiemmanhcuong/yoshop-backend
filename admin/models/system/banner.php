<?php

$limit = 10;
$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($curr_page - 1) * $limit;

$sql = "SELECT * FROM banners LIMIT $limit OFFSET $offset";
$banners = query($sql)->fetchAll(PDO::FETCH_ASSOC);

$banner_count = query("SELECT * FROM banners")->rowCount();
$pages = ceil($banner_count / $limit);