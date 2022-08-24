<?php

if(!checkManagers('users',$_SESSION['user']['managers'])){
    redirect(WEB_ROOT . '/404.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();

    $surname = validateInput($_POST['surname']);
    $name = validateInput($_POST['name']);
    $email = validateInput($_POST['email']);
    $phone = validateInput($_POST['phone']);
    $birthday = validateInput($_POST['birthday']);

    if(empty($surname)){
        $errors['surname'] = 'Vui lòng nhập họ và tên đệm';
    }else {
        if(mb_strlen($surname,'utf-8') > 50){
            $errors['surname'] = 'Họ và tên đệm không được quá 50 ký tự';
        }
    }

    if(empty($name)){
        $errors['name'] = 'Vui lòng nhập tên người dùng';
    }else {
        if(mb_strlen($name,'utf-8') > 25){
            $errors['name'] = 'Tên người dùng không được quá 25 ký tự';
        }
    }

    if(empty($email)){
        $errors['email'] = 'Vui lòng nhập email người dùng';
    }else {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email người dùng không hợp lệ';
        }
    }

    if(empty($phone)){
        $errors['phone'] = 'Vui lòng nhập số điện thoại người dùng';
    }else {
        $pattern = '/^(0|\+84)+[0-9]{9,10}$/';
        $check = preg_match($pattern,$phone);
        if(!$check) {
            $errors['phone'] = 'Số điện thoại không hợp lệ';
        }
    }

    if(empty($birthday)){
        $errors['birthday'] = 'Ngày tháng năm sinh không được để trống';
    }

    if(empty($_POST['sex'])){
        $errors['sex'] = 'Giới tính không được để trống';
    }else {
        $sex = validateInput($_POST['sex']);
    }

    if(empty($password)){
        $errors['password'] = 'Vui lòng nhập mật khẩu';
    }else {
        if(mb_strlen($password,'utf-8') < 6){
            $errors['password'] = 'Mật khẩu phải trên 6 ký tự';
        }
    }

    if(empty($errors)){
        $salt_password = password_hash($password, PASSWORD_BCRYPT,array('cost' =>11));

        $sql = "INSERT INTO users(surname,name,email,phone,password,birthday,sex) VALUES(?,?,?,?,?,?,?)";
        $result = query($sql,[
            $surname,
            $name,
            $email,
            $phone,
            $salt_password,
            $birthday,
            $sex,
        ]);

        if($result->rowCount() > 0) {
            redirect(WEB_ROOT . '/customer?msg=Sửa người dùng thành công');
        }else {
            $error = 'Sửa người dùng thất bại vui lòng thêm lại hoặc liên hệ quản trị viên';
        }
    }
}