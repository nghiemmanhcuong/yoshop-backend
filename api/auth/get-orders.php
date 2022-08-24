<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Auth.php');

$database = new Database();
$conn = $database->connect();

$auth = new Auth($conn);

if(!empty($_GET['userId'])){
    $user_id = $_GET['userId'];
    $result = $auth->getOrders($user_id);

    if($result['success']){
        $data = array();
        $data['success'] = true;
        $data['data'] = $result['data'];
        echo json_encode($data);
        
    }else {
        echo json_encode($result);
    }
}else {
    echo json_encode([
        'success' => false,
        'message' => 'Lấy đơn hàng thất bại'
    ]);
}