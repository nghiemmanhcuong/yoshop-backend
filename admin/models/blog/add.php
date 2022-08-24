<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();

    $title = validateInput($_POST['title']);
    $desc = validateInput($_POST['desc']);
    $content = validateInput($_POST['content']);

    if(empty($title)){
        $errors['title'] = 'Tiêu đề không được để trống';
    }else {
        if(mb_strlen($title,'utf-8') > 500){
            $errors['title'] = 'Tiêu đề không được trên 500 ký tự';
        }
    }

    if(empty($desc)){
        $errors['desc'] = 'Mô tả bài viết không được để trống';
    }else {
        if(mb_strlen($desc,'utf-8') > 1000){
            $errors['desc'] = 'Mô tả bài viết không được trên 1000 ký tự';
        }
    }

    if(empty($content)){
        $errors['content'] = 'Nội dung không được để trống';
    }

    if(empty($author)){
        $author = $_SESSION['user']['name'];
    }else {
        $author = validateInput($_POST['author']);
    }

    if($_FILES['image']['size'] > 0){
        $result = handleUpload($_FILES['image']);

        if(!empty($result['error'])){
            $errors['image'] = $result['error'];
        }else {
            $image = $result['file'];
        }
    }else {
        $errors['image'] = 'Ảnh bài viết không được để trống';
    }

    if(empty($errors)){
        $slug = toSlug($title);

        $sql = "INSERT INTO blogs(title,description,content,author,image,slug) VALUES(?,?,?,?,?,?)";
        $result = query($sql,[
            $title,
            $desc,
            $content,
            $author,
            $image,
            $slug
        ]);

        if($result->rowCount() > 0) {
            $title = '';
            $desc = '';
            $author = '';
            $content = '';
            $success = 'Thêm bài viết thành công';
        }else {
            $error = 'Thêm bài viết thất bại, thêm lại hoặc liên hệ quản trị viên';
        }
    }
}