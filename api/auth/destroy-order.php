<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Auth.php');

$database = new Database();
$conn = $database->connect();

$auth = new Auth($conn);

if(!empty($_GET['orderId'])){
    $order_id = $_GET['orderId'];
    $result = $auth->destroyOrder($order_id);

    echo json_encode($result);
}else {
    echo json_encode([
        'success' => false,
        'message' => 'Huỷ đơn hàng thất bại'
    ]);
}