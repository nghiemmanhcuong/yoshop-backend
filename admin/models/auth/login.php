<?php

if(isset($_SESSION['user'])){
    redirect(WEB_ROOT . '/statistical');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();

    $email = validateInput($_POST['email']);
    $password = validateInput($_POST['password']);

    if(empty($email)){
        $errors['email'] = 'Email không được để trống';
    }

    if(empty($password)){
        $errors['password'] = 'Mật khẩu không được để trống';
    }
    

    if(empty($errors)){
        $sql = "SELECT email,name,access,password,managers FROM users WHERE email=?";
        $user = query($sql,[$email])->fetch(PDO::FETCH_ASSOC);

        if($user && ($user['access'] == 'admin' || $user['access'] == 'saff')){
            if(password_verify($password,$user['password'])){
                $managers = json_decode($user['managers']);
                $_SESSION['user'] = [
                    'email'=>$user['email'],
                    'access'=>$user['access'],
                    'name'=>$user['name'],
                    'managers'=>$managers,
                ];

                redirect(WEB_ROOT . '/statistical');
                
            }else {
                $errors['password'] = 'Tài khoản hoặc mật khẩu không chính xác';
            }
        }else {
            $errors['password'] = 'Tài khoản hoặc mật khẩu không chính xác';
        }
    }
}