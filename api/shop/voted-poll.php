<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Shop.php');

$database = new Database();
$shop = new Shop($database->connect());

if(!empty($_GET['choose_voted'])){
    $choose_voted = $_GET['choose_voted'];
    $result = $shop->votedPoll($choose_voted);
    
    echo json_encode($result);
}else {
    echo json_encode([
        "message"=>"Lỗi khi thực hiện update voted",
        'success'=>false,
    ]);
}
