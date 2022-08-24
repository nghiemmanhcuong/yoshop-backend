<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Products.php');

$database = new Database();
$connect = $database->connect();

$products = new Products($connect);

if(isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];
    $stmt = $products->searchProduct($keyword);

    if($stmt != false && $stmt->rowCount() > 0) {
        $result = array();
        $result['data'] = array();

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
            array_push($result['data'], $product_item);
        }
        $result['success'] = true;
        echo json_encode($result);
    }else {
        echo json_encode([
            "message"=>"Không tìm thấy sản phẩm nào",
            'success'=>false,
        ]);
    }
}else {
    echo json_encode([
        "message"=>"Lỗi khi thực hiện lấy dữ liệu",
        'success'=>false,
    ]);
}
