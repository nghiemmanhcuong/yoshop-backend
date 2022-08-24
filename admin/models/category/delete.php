<?php

if(!checkManagers('categories',$_SESSION['user']['managers'])){
    redirect(WEB_ROOT . '/404.php');
}

if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    $sql = "DELETE FROM categories WHERE id=?";
    $result = query($sql,[$category_id]);

    if($result->rowCount() > 0){
        $sql = "UPDATE products SET category_id=0 WHERE category_id=?";
        query($sql,[$category_id]);
        
        redirect(WEB_ROOT.'/category?msg=Xoá danh mục thành công');
    }else {
        redirect(WEB_ROOT.'/category');
    }
}else {
    redirect(WEB_ROOT.'/category');
}