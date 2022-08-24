<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once('../config/db_conn.php');
require_once('../models/Blogs.php');

$database = new Database();
$conn = $database->connect();

$blogs = new Blogs($conn);

if(isset($_GET['limit'])) {
    $limit = $_GET['limit'];

    $result = $blogs->getNewBlogs($limit);

    if($result['success']){
        $stmt = $result['stmt'];
        $data = array();
        $data['data'] = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $blog_item = [
                'title'=>$row['title'],
                'image'=>$row['image'],
                'author'=>$row['author'],
                'slug'=>$row['slug'],
                'description'=>$row['description'],
                'createdAt'=>$row['created_at'],
            ];

            array_push($data['data'],$blog_item);
        }

        $data['success'] = true;
        echo json_encode($data);

    }else {
        echo json_encode($result);
    }

}else {
    echo json_encode([
        'success' => false,
        'message' => 'Có lỗi khi lấy dữ liệu'
    ]);
}

