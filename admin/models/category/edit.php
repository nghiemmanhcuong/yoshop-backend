<?php

if(!checkManagers('categories',$_SESSION['user']['managers'])){
    redirect(WEB_ROOT . '/404.php');
}

if($_GET['category_id']){
    $category_id = $_GET['category_id'];
    $sql = "SELECT * FROM categories WHERE id=?";
    $category = query($sql,[$category_id])->fetch(PDO::FETCH_ASSOC);

    if(empty($category)){
        redirect(WEB_ROOT.'/category');
    }
}else {
    redirect(WEB_ROOT.'/category');
}

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
        $sql = "UPDATE categories SET name=?,slug=? WHERE id=?";
        $result = query($sql,[$category_name,$slug,$category_id]);

        if($result->rowCount() > 0) {
            redirect(WEB_ROOT.'/category?msg=Sửa danh mục thành công');
        }
    }
}