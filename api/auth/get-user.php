<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Auth.php');

$database = new Database();
$conn = $database->connect();

$auth = new Auth($conn);

if(!empty($_GET['userEmail'])){
    $userEmail = $_GET['userEmail'];
    $result = $auth->getCurrentUser($userEmail);

    if($result['success']){
        echo json_encode($result); 
    }else {
        echo json_encode([
            'success' => false,
            'message' => 'Lấy người dùng thất bại',
        ]);
    }
}else {
    echo json_encode([
        'success' => false,
        'message' => 'Lấy người dùng thất bại',
    ]);
}