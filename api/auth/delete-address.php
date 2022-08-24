<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

require_once('../config/db_conn.php');
require_once('../models/Auth.php');

$database = new Database();
$conn = $database->connect();

$auth = new Auth($conn);

if(isset($_GET['user_address_id'])){
    $user_address_id = $_GET['user_address_id'];
    $result = $auth->deleteUserAddress($user_address_id);
    
    echo json_encode($result);
    
}else {
    echo json_encode([
        'success' => false,
        'message' => 'Có lỗi khi thực hiện xoá địa chỉ người dùng',
    ]);
}