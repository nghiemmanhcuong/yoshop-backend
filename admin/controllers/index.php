<?php

if(!empty($_SERVER['PATH_INFO'])){
    $url = $_SERVER['PATH_INFO'];
    $url_arr = explode("/",$url);
    $url_arr = array_filter($url_arr);
    $url_arr = array_values($url_arr);
    
    $folder = $url_arr[0];
    if(!empty($url_arr[1])){
        $action = $url_arr[1];
    }else {
        $action = '';
    }

}else {
    $folder = '';
    $action = '';
}

switch ($folder) {
    case '':
        require_once('models/auth/login.php');
        include_once('views/auth/login.php');
        break;

    case 'logout': 
        require_once('models/auth/logout.php');
        break;

    case 'forgot-password':
        require_once('models/auth/forgot-password.php');
        include_once('views/auth/forgot-password.php');
        break;

    case 'validation-code':
        require_once('models/auth/code-validation.php');
        include_once('views/auth/code-validation.php');
        break;

    case 'change-password':
        require_once('models/auth/change-password.php');
        include_once('views/auth/change-password.php');
        break;

    case 'statistical':
        handleImport('statistical/index.php','statistical/index.php','Tổng hợp thống kê');
        break;

    case 'user':
        switch ($action) {
            case '':
                handleImport('user/index.php','user/read.php','Danh sách quản trị viên');
                break;

            case 'customer':
                handleImport('user/customer.php','user/customer.php','Danh sách khách hàng');
                break;

            case 'add':
                handleImport('user/add.php','user/add.php','Thêm quản trị viên');
                break;

            case 'edit':
                handleImport('user/edit.php','user/edit.php','Sửa thông tin quản trị viên');
                break;

            case 'delete':
                handleImport('','user/delete.php','');
                break;

            default:
                include_once('views/error/404.php');
                break;
        }
        break;

    case 'customer':
        switch ($action) {
            case '':
                handleImport('customer/index.php','customer/read.php','Danh sách khách hàng');
                break;

            case 'add':
                handleImport('customer/add.php','customer/add.php','Thêm khách hàng');
                break;

            case 'edit':
                handleImport('customer/edit.php','customer/edit.php','Sửa thông tin khách hàng');
                break;

            case 'delete':
                handleImport('','customer/delete.php','');
                break;

            default:
                include_once('views/error/404.php');
                break;
        }
        break;

    case 'product':
        switch ($action) {
            case '':
                handleImport('product/index.php','product/read.php','Danh sách sản phẩm');
                break;

            case 'add':
                handleImport('product/add.php','product/add.php','Thêm sản phẩm');
                break;

            case 'edit':
                handleImport('product/edit.php','product/edit.php','Sửa sản phẩm');
                break;

            case 'comment':
                handleImport('product/comment.php','product/comment.php','Bình luận sản phẩm');
                break;

            case 'comment-list':
                handleImport('product/comment-list.php','product/comment-list.php','Danh sách bình luận');
                break;

            case 'delete':
                handleImport('','product/delete.php','');
                break;

            case 'comment-delete':
                handleImport('','product/comment-delete.php','');
                break;
            
            default:
                include_once('views/error/404.php');
                break;
        }
        break;

    case 'category':
        switch ($action) {
            case '':
                handleImport('category/index.php','category/read.php','Danh sách danh mục');
                break;

            case 'add':
                handleImport('category/add.php','category/add.php','Thêm danh mục');
                break;

            case 'edit':
                handleImport('category/edit.php','category/edit.php','Sửa danh mục');
                break;

            case 'delete':
                handleImport('','category/delete.php','');
                break;

            default:
                include_once('views/error/404.php');
                break;
        }    
        break;

    case 'blog':
        switch ($action) {
            case '':
                handleImport('blog/index.php','blog/read.php','Danh sách bài viết');
                break;

            case 'add':
                handleImport('blog/add.php','blog/add.php','Thêm bài viết');
                break;

            case 'edit':
                handleImport('blog/edit.php','blog/edit.php','Sửa bài viết');
                break;

            case 'delete':
                handleImport('','blog/delete.php','');
                break;

            default:
                include_once('views/error/404.php');
                break;
        }    
        break;

    case 'order':
        switch ($action) {
            case '':
                handleImport('order/index.php','order/read.php','Danh sách đơn hàng');
                break;

            case 'status':
                handleImport('order/status.php','order/status.php','Trạng thái đơn hàng');
                break;

            case 'detail':
                handleImport('order/detail.php','order/detail.php','Chi tiết đơn hàng');
                break;

            default:
                include_once('views/error/404.php');
                break;
        }
        break;

    case 'contact':
        switch ($action) {
            case '':
                handleImport('contact/index.php','contact/read.php','Danh sách liên hệ');
                break;

            case 'detail':
                handleImport('contact/detail.php','contact/detail.php','Chi tiết liên hệ');
                break;

            default:
                include_once('views/error/404.php');
                break;
        }
        break;

    case 'system':
        switch ($action) {
            case 'banner':
                handleImport('system/banner.php','system/banner.php','Banner website');
                break;

            case 'banner-add':
                handleImport('system/banner-add.php','system/banner-add.php','Thêm banner website');
                break;

            case 'banner-edit':
                handleImport('system/banner-edit.php','system/banner-edit.php','Sửa banner website');
                break;

            case 'banner-delete':
                handleImport('','system/banner-delete.php','');
                break;

            case 'shop-info':
                handleImport('system/shop-info.php','system/shop-info.php','Thông tin shop trên website');
                break;

            case 'probe':
                handleImport('system/probe.php','system/probe.php','Thăm dò ý kiến');
                break;
        }
        break;

    default:
        include_once('views/error/404.php');
        break;
}