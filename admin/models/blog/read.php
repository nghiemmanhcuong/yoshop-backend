<?php

$limit = 10;
$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($curr_page - 1) * $limit;

$sql = "SELECT * FROM blogs LIMIT $limit OFFSET $offset";
$blogs = query($sql)->fetchAll(PDO::FETCH_ASSOC);

$blog_count = query("SELECT * FROM blogs")->rowCount();
$pages = ceil($blog_count / $limit);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(isset($_POST['chooseRows'])){
        $chooseRowId = $_POST['chooseRows'];
    }else {
        $error = 'Bạn chưa chọn bản ghi nào';
    }

    if(!isset($error)){
        $check = true;
        $sql = "DELETE FROM blogs WHERE id=?";
        foreach ($chooseRowId as $id) {
            $result = query($sql,[$id]);
            if($result->rowCount() == 0) {
                $check = false;
            }
        }

        if($check) {
            redirect(WEB_ROOT . '/blog?msg=Xoá tất cả bản ghi đã chọn thành công');
        }else {
            $error = 'Xoá tất cả bản ghi thất bại';
        }
    }
}