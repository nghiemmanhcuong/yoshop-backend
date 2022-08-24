<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once('../config/db_conn.php');
require_once('../models/Blogs.php');

$database = new Database();
$conn = $database->connect();

$blogs = new Blogs($conn);

if(isset($_GET['slug'])){
    $slug = trim($_GET['slug']);
    $result = $blogs->getBlogBySlug($slug);

    echo json_encode($result);
    
}else {
    echo json_encode([
        'success' => false,
        'message' => 'Có lỗi khi lấy dữ liệu'
    ]);
}