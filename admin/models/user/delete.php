<?php

if($_SESSION['user']['access'] == 'saff'){
    redirect(WEB_ROOT.'/404.php');
}

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $sql = "DELETE FROM users WHERE id=?";
    $result = query($sql,[$user_id]);

    if($result->rowCount() > 0){
        redirect(WEB_ROOT.'/user?msg=Xoá người dùng thành công');
    }else {
        redirect(WEB_ROOT.'/user');
    }
}else {
    redirect(WEB_ROOT.'/user');
}