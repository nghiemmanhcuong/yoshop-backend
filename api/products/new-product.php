<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Products.php');

$database = new Database();
$connect = $database->connect();

$products = new Products($connect);

$data = array();
if(isset($_GET['limit'])){
    $data['limit'] = $_GET['limit'];
}

if(isset($data)) {
    $stmt = $products->getNewProduct($data);
}else {
    $stmt = $products->getNewProduct();
}

if($stmt->rowCount() > 0) {
    $products_array = array();
    $products_array['data'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
            'slug' => $row['slug']
        ];
        array_push($products_array['data'], $product_item);
    }

    echo json_encode($products_array);
}else {
    echo json_encode([
        'message' => 'Không tìm thấy sản phẩm nào',
        'success' => false,
    ]);
}
