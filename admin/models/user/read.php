<?php

if($_SESSION['user']['access'] == 'saff'){
    redirect(WEB_ROOT.'/404.php');
}

$limit = 14;
$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($curr_page - 1) * $limit;

$sql = "SELECT id,surname,name,email,phone,birthday,access,sex FROM users  WHERE access=? ORDER BY id DESC LIMIT $limit OFFSET $offset";
$users = query($sql,['saff'])->fetchAll(PDO::FETCH_ASSOC);

$user_count = query("SELECT id,surname,name,email,phone,birthday,access,sex FROM users WHERE access='saff'")->rowCount();
$pages = ceil($user_count / $limit);