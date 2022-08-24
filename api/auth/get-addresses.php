<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Auth.php');

$database = new Database();
$conn = $database->connect();

$auth = new Auth($conn);

if(isset($_GET['userId'])){
    $userId = $_GET['userId'];
    $result = $auth->getUserAddress($userId);

    echo json_encode($result);

}else {
    echo json_encode([
        'success' => false,
        'message' => 'Có lỗi khi thực hiện lấy địa chỉ người dùng',
    ]);
}
