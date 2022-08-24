<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="shortcut icon" href="//theme.hstatic.net/200000258387/1000809443/14/favicon.png?v=47" type="image/png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?=WEB_ROOT?>/public/css/config-boostrap.css">
    <link rel="stylesheet" href="<?=WEB_ROOT?>/public/css/main.css">
    <title><?=!empty($web_title) ? $web_title.'-YO8' : 'YO8'?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?=WEB_ROOT?>">YO8</a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="<?=WEB_ROOT?>/statistical">
                            Thống kê
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown">
                            Người dùng
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?=WEB_ROOT?>/customer"><i
                                        class="bi bi-plus-circle-fill"></i>Danh sách khách hàng</a></li>
                            <?php if($_SESSION['user']['access'] == 'admin'):?>
                            <li><a class="dropdown-item" href="<?=WEB_ROOT?>/user"><i
                                        class="bi bi-plus-circle-fill"></i>Danh sách quản trị viên</a></li>
                            <li><a class="dropdown-item" href="<?=WEB_ROOT?>/user/add"><i
                                        class="bi bi-plus-circle-fill"></i>Thêm quản trị viên</a></li>
                            <?php endif;?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown">
                            Sản phẩm
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?=WEB_ROOT?>/product"><i
                                        class="bi bi-plus-circle-fill"></i>Danh
                                    sách</a></li>
                            <li><a class="dropdown-item" href="<?=WEB_ROOT?>/product/add"><i
                                        class="bi bi-plus-circle-fill"></i>Thêm sản phẩm</a></li>
                            <li><a class="dropdown-item" href="<?=WEB_ROOT?>/product/comment"><i
                                        class="bi bi-plus-circle-fill"></i>Thống kế bình luận</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown">
                            Danh mục SP
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?=WEB_ROOT?>/category"><i
                                        class="bi bi-plus-circle-fill"></i>Danh sách</a></li>
                            <li><a class="dropdown-item" href="<?=WEB_ROOT?>/category/add"><i
                                        class="bi bi-plus-circle-fill"></i>Thêm danh mục</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown">
                            Bài viết
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?=WEB_ROOT?>/blog"><i
                                        class="bi bi-plus-circle-fill"></i>Danh sách</a></li>
                            <li><a class="dropdown-item" href="<?=WEB_ROOT?>/blog/add"><i
                                        class="bi bi-plus-circle-fill"></i>Thêm bài viết</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="<?=WEB_ROOT?>/order">
                            Đơn hàng
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="<?=WEB_ROOT?>/contact">
                            Liên hệ
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown">
                            Hệ thống
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?=WEB_ROOT?>/system/banner"><i
                                        class="bi bi-plus-circle-fill"></i> Banner web</a></li>
                            <li><a class="dropdown-item" href="<?=WEB_ROOT?>/system/shop-info"><i
                                        class="bi bi-plus-circle-fill"></i> Thông tin shop</a></li>
                            <li><a class="dropdown-item" href="<?=WEB_ROOT?>/system/probe"><i
                                        class="bi bi-plus-circle-fill"></i> Thăm dò ý kiến</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="header_user d-flex" style="color:white;">
                <div class="header_user_info me-3">
                    Xin chào: <?=isset($_SESSION['user']) ? $_SESSION['user']['name'] : ''?>
                </div>
                <a href="<?=WEB_ROOT.'/logout'?>" style="color:white;"><i class="bi bi-box-arrow-right"></i></a>
            </div>
        </div>
    </nav>