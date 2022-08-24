<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $error = '';
    $email = validateInput($_POST['email']);

    if(empty($email)){
        $error = 'Email của bạn không được để trống';
    }

    if(empty($error)){
        $sql = "SELECT email FROM users WHERE email=?";
        $user = query($sql,[$email])->fetch(PDO::FETCH_ASSOC);

        if($user){
            $code = uniqid();
            $content = "Mã xác nhận của bạn là <strong>".$code."</strong>";
            setcookie('code', $code,time() + 120);
            $_SESSION['password_changer_email'] = $user['email'];
            require_once('config/email/sendmail.php');
            redirect(WEB_ROOT . '/validation-code');
        }else {
            $error = 'Không tìm thấy email';
        }
    }
}