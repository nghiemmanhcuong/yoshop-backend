<?php

if(!checkManagers('systems',$_SESSION['user']['managers'])){
    redirect(WEB_ROOT.'/404.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();

    $height = validateInput($_POST['height']);
    $width = validateInput($_POST['width']);

    if(empty($height)){
        $errors['height'] = 'Vui lòng nhập kích thước chiều cao ảnh';
    }else {
        if(!filter_var($height,FILTER_VALIDATE_INT) || $height < 0){
            $errors['height'] = 'Chiều cao ảnh không hợp lệ';
        }
    }

    if(empty($width)){
        $errors['width'] = 'Vui lòng nhập kích thước chiều rộng ảnh';
    }else {
        if(!filter_var($width,FILTER_VALIDATE_INT) || $width < 0){
            $errors['width'] = 'Chiều rộng ảnh không hợp lệ';
        }
    }

    if($_FILES['image']['size'] > 0) {
        $result = handleUpload($_FILES['image']);

        if(!empty($result['error'])){
            $errors['image'] = $result['error'];
        }else {
            $image = $result['file'];
        }
    }else {
        $errors['image'] = 'Thêm ảnh của banner';
    }

    if(empty($errors)){
        $sql = "INSERT INTO banners(image,width,height) VALUES(?,?,?)";
        $result = query($sql,[$image,$width,$height]);

        if($result->rowCount() > 0) {
            $success = 'Thêm banner thành công';
        }else {
            $error = 'Thêm banner thất bại';
        }
    }
}