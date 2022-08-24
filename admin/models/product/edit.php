<?php

if(!checkManagers('products',$_SESSION['user']['managers'])){
    redirect(WEB_ROOT . '/404.php');
}

if(!empty($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM products WHERE id=?";
    $product = query($sql,[$product_id])->fetch(PDO::FETCH_ASSOC);

    if(empty($product)){
        redirect(WEB_ROOT.'/product');
    }
    
    $sql = "SELECT * FROM categories";
    $categories = query($sql)->fetchAll(PDO::FETCH_ASSOC);

    $product_sizes = json_decode($product['sizes']);
}else {
    redirect(WEB_ROOT.'/product');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();

    $name = validateInput($_POST['name']);
    $category = validateInput($_POST['category']);
    $oldPrice = validateInput($_POST['oldPrice']);
    $newPrice = validateInput($_POST['newPrice']);
    $discount = validateInput($_POST['discount']);
    $quantity = validateInput($_POST['quantity']);
    $color = validateInput($_POST['color']);
    $description = validateInput($_POST['description']);
    $status = validateInput($_POST['status']);

    if(empty($name)){
        $errors['name'] = 'Tên sản phẩm không được để trống';
    }else {
        if(mb_strlen($name,'utf-8') > 150) {
            $errors['name'] = 'Tên sản phẩm không được quá 150 ký tự';
        }
    }

    if(empty($oldPrice)){
       $oldPrice = 0;
    }else {
        if(!is_numeric($oldPrice)){
            $errors['oldPrice'] = 'Giá không hợp lệ';
        }
    }

    if(empty($newPrice)){
        $errors['newPrice'] = 'Giá bán không được để trống';
    }else {
        if(!is_numeric($newPrice)){
            $errors['newPrice'] = 'Giá bán không hợp lệ';
        }
    }

    if(empty($discount)){
        $discount = 0;
    }else {
        if(!is_numeric($discount)){
            $errors['discount'] = 'Giảm giá không hợp lệ';
        }
    }

    if(empty($quantity)){
        $errors['quantity'] = 'Số lượng không được để trống';
    }else {
        if(!filter_var($quantity,FILTER_VALIDATE_INT,['option'=>['min_range'=>0]])){
            $errors['quantity'] = 'Số lượng không hợp lệ';
        }
    }

    if(empty($color)){
        $errors['color'] = 'Màu không được để trống';
    }

    if(!isset($_POST['sizes'])) {
        $sizes = null;
    }else {
        $sizes = $_POST['sizes'];
        $sizes = json_encode($sizes);
    }

    if(empty($description)){
        $errors['description'] = 'Mô tả không được để trống';
    }
    
    if(isset($_POST['is_new'])){
        $is_new = $_POST['is_new'];
    }else {
        $is_new = 0;
    }

    if(isset($_POST['is_popular'])){
        $is_popular = $_POST['is_popular'];
    }else {
        $is_popular = 0;
    }

    if($_FILES['images']['size'][0] > 0) {
        if(empty($errors)){
            $result = handleUploadMultiple($_FILES['images']);
            if(!empty($result['errors'])){
                $errors['images'] = $result['errors'];
            }else {
                $images = $result['files'];
                $images = json_encode($images);
            }
        }
    }else {
        $images = $product['images'];
    }

    $slug = toSlug($name);

    if(empty($errors)){
        global $conn;

        $sql = "UPDATE products SET category_id=?,name=?,oldPrice=?,newPrice=?,discount=?,
                quantity=?,description=?,color=?,sizes=?,images=?,is_new=?,is_popular=?,slug=?,status=?
                WHERE id=?";
        $result = query($sql,[$category,$name,$oldPrice,$newPrice,
        $discount,$quantity,$description,$color,$sizes,$images,$is_new,$is_popular,$slug,$status,$product['id']]);

        $conn = null;

        if($result->rowCount() > 0){
            redirect(WEB_ROOT.'/product?msg=Sửa sản phẩm thành công');
        }
    }
}