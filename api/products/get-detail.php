<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Products.php');

$database = new Database();
$products = new Products($database->connect());

if(isset($_GET['slug'])){
    $slug = $_GET['slug'];
    $stmt = $products->getProductBySlug($slug);

    if(!$stmt){
        echo json_encode([
            'message' => 'Không tìm thấy sản phẩm nào',
            'success' => false,
        ]);
    }else {
        $data = array();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $data['data'] = $product;
        $data['success'] = true;
        echo json_encode($data);
    }

}else {
    echo json_encode([
        'message' => 'Không tìm thấy sản phẩm nào',
        'success' => false,
    ]);
}

