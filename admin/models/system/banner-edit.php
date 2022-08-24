<?php

if(!checkManagers('systems',$_SESSION['user']['managers'])){
    redirect(WEB_ROOT.'/404.php');
}

if(!empty($_GET['banner_id'])){
    $banner_id = $_GET['banner_id'];
    $sql = "SELECT * FROM banners WHERE id=?";
    $banner = query($sql,[$banner_id])->fetch(PDO::FETCH_ASSOC);

    if(!$banner){
        redirect(WEB_ROOT.'/system/banner');
    }
}else {
    redirect(WEB_ROOT.'/system/banner');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();

    $height = validateInput($_POST['height']);
    $width = validateInput($_POST['width']);
    $status = validateInput($_POST['status']);

    if(empty($height)){
        $errors['height'] = 'Vui lòng nhập kích thước chiều cao ảnh';
    }

    if(empty($width)){
        $errors['width'] = 'Vui lòng nhập kích thước chiều rộng ảnh';
    }

    if($_FILES['image']['size'] > 0) {
        $result = handleUpload($_FILES['image']);

        if(!empty($result['error'])){
            $errors['image'] = $result['error'];
        }else {
            $image = $result['file'];
        }
    }else {
        $image = $banner['image'];
    }

    if(empty($errors)){
        $sql = "UPDATE banners SET image=?,width=?,height=?,status=? WHERE id=?";
        $result = query($sql,[$image,$width,$height,$status,$banner['id']]);

        if($result->rowCount() > 0) {
            redirect(WEB_ROOT.'/system/banner?msg=Sửa banner thành công');
        }
    }
}