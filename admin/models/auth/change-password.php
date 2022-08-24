<?php

if(!isset($_SESSION['password_changer_email'])){
    redirect(WEB_ROOT.'/404');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();

    $new_password = validateInput($_POST['new_password']);
    $retype_new_password = validateInput($_POST['retype_new_password']);

    if(empty($new_password)){
        $errors['new_password'] = 'Nhập mật khẩu mới';
    }

    if(empty($retype_new_password)){
        $errors['retype_new_password'] = 'Nhập lại mật khẩu mới';
    }else {
        if($_POST['new_password'] != $retype_new_password){
            $errors['retype_new_password'] = 'Mật khẩu không khớp';
        }
    }

    if(empty($errors)){
        $password_changer_email = $_SESSION['password_changer_email'];
        $hash_password = password_hash($new_password, PASSWORD_BCRYPT,array('cost' =>11));
        $sql = "UPDATE users SET password=? WHERE email=?";
        $result = query($sql,[$hash_password,$password_changer_email]);

        if($result->rowCount() > 0) {
            unset($_SESSION['password_changer_email']);
            redirect(WEB_ROOT.'?msg=Thay đổi mật khẩu thành công');
        }
    }
}