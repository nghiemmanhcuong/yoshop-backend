<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?=WEB_ROOT?>/public/css/config-boostrap.css">
    <link rel="stylesheet" href="<?=WEB_ROOT?>/public/css/main.css">
    <title>Khôi phục mật khẩu</title>
</head>
<style>
.login {
    background-image: linear-gradient(to right, #06b6d4, #3b82f6);
}

.login>form {
    background-color: #ffffff;
}

.forgot-password {
    color: #0d6efd;
    font-size: 13px;
}

.forgot-password > a {
    text-decoration:unset;
}
</style>

<body>
    <div class="login d-flex align-items-center justify-content-center" style="height:100vh;">
        <form method="post" class="form-add" style="width:30%">
            <h3 class="text-center">Nhập mã xác thực</h3>
            <div class="mb-3">
                <label class="form-label">Mã xác thực</label>
                <input type="text" name="code_input" class="form-control">
                <?php if(isset($error)):?>
                <div class="form-error"><?=$error?></div>
                <?php endif;?>
            </div>
            <div class="form-error mb-2">Mã xác thực xẽ hết hạn sau 120 giây</div>
            <div class="mb-2 forgot-password">
                <i class="bi bi-arrow-left"></i>
                <a href="<?=WEB_ROOT.'/forgot-password'?>">Gửi lại mã</a>
            </div>
            <div class="form-button">
                <button class="btn btn-primary">khôi phục</button>
            </div>
        </form>
    </div>
    <script src="<?=WEB_ROOT?>/public/js/main.js"></script>
</body>

</html>