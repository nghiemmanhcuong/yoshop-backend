<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Products.php');

$database = new Database();
$conn = $database->connect();

$products = new Products($conn);

if(isset($_GET['product_id'])){
    $result = $products->getProductComments($_GET['product_id']);
    
    if($result['success']){
        $stmt = $result['stmt'];
        $data = array();
        $data['data'] = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $comment_item = [
                'userName' => $row['user_name'],
                'title' => $row['title'],
                'content' => $row['content'],
                'createdAt' => $row['created_at'],
            ];
            array_push($data['data'], $comment_item);
        }

        $data['success'] = true;
        echo json_encode($data);

    }else {
        echo json_encode($result);
    }

}else {
    echo json_encode([
        'success' => false,
        'message' => 'Có lỗi khi thực hiện lấy dữ liệu'
    ]);
}