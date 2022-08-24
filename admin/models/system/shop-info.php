<?php
$sql = "SELECT * FROM shop_info";
$shop_info = query($sql)->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();

    $shop_phone = validateInput($_POST['shop_phone']);
    $shop_email = validateInput($_POST['shop_email']);
    $shop_address = validateInput($_POST['shop_address']);
    $about_text = validateInput($_POST['about_text']);

    if(empty($shop_phone)){
        $errors['shop_phone'] = 'Số điện thoại không được để trống';
    }else {
        $pattern = '/^(0|\+84)+[0-9]{9,10}$/';
        $check = preg_match($pattern,$shop_phone);
        if(!$check) {
            $errors['shop_phone'] = 'Số điện thoại không hợp lệ';
        }
    }

    if(empty($shop_email)){
        $errors['shop_email'] = 'Email không được để trống';
    }else {
        $pattern = '/^[0-9a-z]+[a-z\-_\.0-9]*@[a-z\.]*\.[a-z]{2,}$/';
        $check = preg_match($pattern,$shop_email);
        if(!$check) {
            $errors['shop_email'] = 'Email không hợp lệ';
        }
    }

    if(empty($about_text)){
        $errors['about_text'] = 'Giới thiệu không được để trống';
    }


    if(empty($errors)){
        $id= validateInput($_POST['id']);
        $sql = "UPDATE shop_info SET shop_phone=?,shop_email=?,shop_address=?,about_text=? WHERE id=?";
        $result = query($sql,[
            $shop_phone,
            $shop_email,
            $shop_address,
            $about_text,
            $id
        ]);

        if($result->rowCount() > 0) {
            redirect(WEB_ROOT.'/system/shop-info?msg=Sửa thông tin thành công');
        }
    }
}