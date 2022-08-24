<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Shop.php');

$database = new Database();
$shop = new Shop($database->connect());

$stmt = $shop->getBanners();

if($stmt->rowCount() > 0) {
    $banners = array();
    $banners['data'] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $banner_item = [
            'image' => $row['image'],
            'height' => $row['height'],
            'width' => $row['width'],
        ];

        array_push($banners['data'], $banner_item);
    }

    echo json_encode($banners);

}else {
    echo json_encode([
        'message' => 'Không tìm thấy bản ghi nào',
    ]);
}

