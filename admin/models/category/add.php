<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();
    $category_name = validateInput($_POST['name']);

    if(empty($category_name)){
        $errors['name'] = 'Vui lòng nhập tên danh mục';
    }else {
        if(mb_strlen($category_name,'utf-8') > 100){
            $errors['name'] = 'Tên danh mục không được quá 100 ký tự';
        }
    }

    if(empty($errors)){
        $slug = toSlug($category_name);
        $sql = "INSERT INTO categories (name,slug) VALUES(?,?)";
        $result = query($sql,[$category_name,$slug]);

        if($result->rowCount() > 0){
            $success = 'Thêm danh mục thành công';
        }else {
            $error = 'Thêm danh mục thất bại cui lòng thêm lại';
        }
    }
}