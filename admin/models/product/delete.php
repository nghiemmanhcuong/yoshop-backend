<?php

if(!checkManagers('products',$_SESSION['user']['managers'])){
    redirect(WEB_ROOT . '/404.php');
}

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $sql = "DELETE FROM products WHERE id=?";
    $result = query($sql,[$product_id]);

    if($result->rowCount() > 0){
        redirect(WEB_ROOT.'/product?msg=Xoá sản phẩm thành công');
    }else {
        redirect(WEB_ROOT.'/product');
    }
}else {
    redirect(WEB_ROOT.'/product');
}