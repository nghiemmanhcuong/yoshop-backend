<?php

if(!checkManagers('products',$_SESSION['user']['managers'])){
    redirect(WEB_ROOT . '/404.php');
}

if(isset($_GET['comment_id'])){
    $comment_id = $_GET['comment_id'];
    $product_id = $_GET['product_id'];
    $sql = "DELETE FROM product_comments WHERE id=?";
    $result = query($sql,[$comment_id]);

    if($result->rowCount() > 0){
        redirect(WEB_ROOT.'/product/comment-list?product_id='.$product_id.'&msg=Xoá bình luận thành công');
    }else {
        redirect(WEB_ROOT.'/product/comment-list?product_id='.$product_id.'');
    }
}else {
    redirect(WEB_ROOT.'/product/comment-list?product_id='.$product_id.'');
}