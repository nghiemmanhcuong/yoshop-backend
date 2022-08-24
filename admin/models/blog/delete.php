<?php

if(!checkManagers('blogs',$_SESSION['user']['managers'])){
    redirect(WEB_ROOT . '/404.php');
}

if(isset($_GET['blog_id'])){
    $blog_id = $_GET['blog_id'];
    $sql = "DELETE FROM blogs WHERE id=?";
    $result = query($sql,[$blog_id]);

    if($result->rowCount() > 0){
        redirect(WEB_ROOT.'/blog?msg=Xoá bài viết thành công');
    }else {
        redirect(WEB_ROOT.'/blog');
    }
}else {
    redirect(WEB_ROOT.'/blog');
}