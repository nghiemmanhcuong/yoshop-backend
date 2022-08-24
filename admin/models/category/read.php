<?php

$limit = 15;
$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($curr_page - 1) * $limit;

$sql = "SELECT * FROM categories";
$categories = query($sql)->fetchAll(PDO::FETCH_ASSOC);

$category_count = query("SELECT * FROM categories")->rowCount();
$pages = ceil($category_count / $limit);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(isset($_POST['chooseRows'])){
        $chooseRowId = $_POST['chooseRows'];
    }else {
        $error = 'Bạn chưa chọn bản ghi nào';
    }

    if(!isset($error)){
        $check = true;
        $sql_delete_category = "DELETE FROM categories WHERE id=?";
        $sql_update_product = "UPDATE products SET category_id=0 WHERE category_id=?";
        foreach ($chooseRowId as $id) {
            $result_category = query($sql_delete_category,[$id]);
            $result_product = query($sql_update_product,[$id]);
            if($result_category->rowCount() == 0) {
                $check = false;
            }
        }

        if($check) {
            redirect(WEB_ROOT . '/category?msg=Xoá tất cả bản ghi đã chọn thành công');
        }else {
            $error = 'Xoá tất cả bản ghi thất bại';
        }
    }
}