<?php

if(!empty($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $limit = 14;
    $curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($curr_page - 1) * $limit;
    $sql = "SELECT pc.id,pc.user_id,pc.product_id,pc.content,pc.status,pc.created_at,u.name 
            FROM product_comments AS pc INNER JOIN users AS u ON pc.user_id = u.id
            WHERE pc.product_id=? LIMIT $limit OFFSET $offset";
    $product_comments = query($sql,[$product_id])->fetchAll(PDO::FETCH_ASSOC);

    $product_comment_count = query("SELECT * FROM product_comments WHERE product_id=$product_id")->rowCount();
    $pages = ceil($product_comment_count / $limit);
}else {
    redirect(WEB_ROOT . '/product/comment');
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])){
    $product_comment_id = $_POST['product_comment_id'];
    if(isset($_POST['chooseRows'])){
        $chooseRowId = $_POST['chooseRows'];
    }else {
        $error = 'Bạn chưa chọn bản ghi nào';
    }

    if(!isset($error)){
        $check = true;
        $sql = "UPDATE product_comments SET status=1 WHERE id=?";
        foreach ($chooseRowId as $id) {
            $result = query($sql,[$id]);
            if($result->rowCount() == 0) {
                $check = false;
            }
        }

        if($check) {
            redirect(WEB_ROOT.'/product/comment-list?product_id='.$product_comment_id.'&msg=Xác nhận mục chọn thành công');
        }else {
            $error = 'xác nhận mục đã chọn thất bại';
        }
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['unconfirm'])){
    $product_comment_id = $_POST['product_comment_id'];
    if(isset($_POST['chooseRows'])){
        $chooseRowId = $_POST['chooseRows'];
    }else {
        $error = 'Bạn chưa chọn bản ghi nào';
    }

    if(!isset($error)){
        $check = true;
        $sql = "UPDATE product_comments SET status=0 WHERE id=?";
        foreach ($chooseRowId as $id) {
            $result = query($sql,[$id]);
            if($result->rowCount() == 0) {
                $check = false;
            }
        }

        if($check) {
            redirect(WEB_ROOT.'/product/comment-list?product_id='.$product_comment_id.'&msg=Bỏ xác nhận mục chọn thành công');
        }else {
            $error = 'Bỏ xác nhận mục đã chọn thất bại';
        }
    }
}