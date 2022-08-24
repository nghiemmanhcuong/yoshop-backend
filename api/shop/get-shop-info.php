<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Shop.php');

$database = new Database();
$shop = new Shop($database->connect());

$shop_info = $shop->getShopInfo();

$data = array();
$data['data'] = $shop_info;
$data['success'] = true;
echo json_encode($data);

