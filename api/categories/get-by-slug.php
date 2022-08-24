<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Categories.php');

$database = new Database();
$categories = new Categories($database->connect());

if(isset($_GET['slug'])){
    $slug = $_GET['slug'];
    $stmt = $categories->getCategoryBySlug($slug);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($category);
    
}else {
    echo json_encode([
        'message' => 'Không tìm thấy bản ghi nào',
        'success' => false,
    ]);
}

