<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Categories.php');

$database = new Database();
$categories = new Categories($database->connect());

$stmt = $categories->getAllCategories();

if($stmt->rowCount() > 0) {
    $category_array = array();
    $category_array['data'] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $category_item = [
            'id' => $row['id'],
            'name' => $row['name'],
            'slug' => $row['slug'],
        ];

        array_push($category_array['data'], $category_item);
    }

    echo json_encode($category_array);

}else {
    echo json_encode([
        'message' => 'Không tìm thấy bản ghi nào',
    ]);
}

