<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Products.php');

$database = new Database();
$conn = $database->connect();

$products = new Products($conn);

if(isset($_GET['category_id'])){
    $result = $products->getProductsRelated($_GET['category_id']);
    
    if($result['success']){
        $stmt = $result['stmt'];
        $data = array();
        $data['data'] = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $product_item = [
                'name' => $row['name'],
                'category_id' => $row['category_id'],
                'oldPrice' => $row['oldPrice'],
                'newPrice' => $row['newPrice'],
                'discount' => $row['discount'],
                'quantity' => $row['quantity'],
                'description' => $row['description'],
                'color' => $row['color'],
                'sizes' => $row['sizes'],
                'images' => $row['images'],
                'slug' => $row['slug'],
            ];
            array_push($data['data'], $product_item);
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