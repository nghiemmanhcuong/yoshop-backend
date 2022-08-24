<?php

if(!checkManagers('blogs',$_SESSION['user']['managers'])){
    redirect(WEB_ROOT . '/404.php');
}

if(!empty($_GET['blog_id'])){
    $blog_id = $_GET['blog_id'];
    $sql = "SELECT * FROM blogs WHERE id=?";
    $blog = query($sql,[$blog_id])->fetch(PDO::FETCH_ASSOC);
}else {
    redirect(WEB_ROOT . '/blog');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();

    $title = validateInput($_POST['title']);
    $desc = validateInput($_POST['desc']);
    $author = validateInput($_POST['author']);
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
        if(mb_strlen($desc,'utf-8') > 500){
            $errors['desc'] = 'Mô tả bài viết không được trên 500 ký tự';
        }
    }

    if(empty($content)){
        $errors['content'] = 'Nội dung không được để trống';
    }

    if(empty($author)){
        $errors['author'] = 'Tác giả không được để trống';
    }

    if($_FILES['image']['size'] > 0){
        $result = handleUpload($_FILES['image']);

        if(!empty($result['error'])){
            $errors['image'] = $result['error'];
        }else {
            $image = $result['file'];
        }
    }else {
        $image = $_POST['img'];
    }

    if(empty($errors)){
        $slug = toSlug($title);
        $id = $_POST['id'];

        $sql = "UPDATE blogs SET title=?,description=?,content=?,author=?,image=?,slug=? WHERE id=?";
        $result = query($sql,[
            $title,
            $desc,
            $content,
            $author,
            $image,
            $slug,
            $id
        ]);

        if($result->rowCount() > 0) {
            redirect(WEB_ROOT . '/blog?msg=Sửa bài viết thành công');
        }
    }
}