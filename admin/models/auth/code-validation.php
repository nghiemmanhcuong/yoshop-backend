<?php

if(!isset($_SESSION['password_changer_email'])){
    redirect(WEB_ROOT.'/404');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $error = '';
    $code_input = validateInput($_POST['code_input']);

    if(empty($code_input)){
        $error = 'Vui lòng nhập mã xác thực';
    }

    if(empty($error)){
        if(isset($_COOKIE['code'])){
            if($_COOKIE['code'] == $code_input){
                redirect(WEB_ROOT.'/change-password');
            }else {
                $error = 'Mã xác thực không chính xác';
            }
        }else {
            $error = 'Mã xác thực của bạn đã hết hạn vui lòng gửi lại mã';
        }
    }
}