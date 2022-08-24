<?php

if(!checkManagers('systems',$_SESSION['user']['managers'])){
    redirect(WEB_ROOT.'/404.php');
}

if(!empty($_GET['banner_id'])){
    $banner_id = $_GET['banner_id'];
    $sql = "DELETE FROM banners WHERE id=?";
    $result = query($sql,[$banner_id]);

    if($result->rowCount() > 0){
        redirect(WEB_ROOT.'/system/banner?msg=Xoá banner thành công');
    }else {
        redirect(WEB_ROOT.'/system/banner');
    }
}else {
    redirect(WEB_ROOT.'/system/banner');
}