<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Shop.php');

$database = new Database();
$shop = new Shop($database->connect());

$poll = $shop->getPoll();

$data = array();
$data['data'] = $poll;
$data['success'] = true;
echo json_encode($data);

