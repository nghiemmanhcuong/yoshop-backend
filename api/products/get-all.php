<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
require_once('../config/db_conn.php');
require_once('../models/Products.php');

$database = new Database();
$connect = $database->connect();

$products = new Products($connect);

$data = json_decode(file_get_contents('php://input'));
$data = [
    'limit' => $data->limit,
    'colors' => $data->colors,
    'sizes' => $data->sizes,
    'sort' => $data->sort,
    'page' => $data->page,
];

$result = $products->getAll($data);

$stmt = $result['stmt'];

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
    $products_array['pages'] = $result['pages'];
    echo json_encode($products_array);
}else {
    echo json_encode([
        'message' => 'Không tìm thấy bản ghi nào',
        'success' => false,
    ]);
}