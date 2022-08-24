<?php

$limit = 14;
$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($curr_page - 1) * $limit;

$sql = "SELECT * FROM products LIMIT $limit OFFSET $offset";
$products = query($sql)->fetchAll(PDO::FETCH_ASSOC);

$product_count = query("SELECT * FROM products")->rowCount();
$pages = ceil($product_count / $limit);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(isset($_POST['chooseRows'])){
        $chooseRowId = $_POST['chooseRows'];
    }else {
        $error = 'Bạn chưa chọn bản ghi nào';
    }

    if(!isset($error)){
        $check = true;
        $sql = "DELETE FROM products WHERE id=?";
        foreach ($chooseRowId as $id) {
            $result = query($sql,[$id]);
            if($result->rowCount() == 0) {
                $check = false;
            }
        }

        if($check) {
            redirect(WEB_ROOT . '/product?msg=Xoá tất cả bản ghi đã chọn thành công');
        }else {
            $error = 'Xoá tất cả bản ghi thất bại';
        }
    }
}