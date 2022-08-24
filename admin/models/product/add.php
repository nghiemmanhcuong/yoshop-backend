<?php

$sql = "SELECT * FROM categories";
$categories = query($sql)->fetchAll(PDO::FETCH_ASSOC);

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

    if(empty($name)){
        $errors['name'] = 'Tên sản phẩm không được để trống';
    }else {
        if(mb_strlen($name,'utf-8') > 150) {
            $errors['name'] = 'Tên sản phẩm không được quá 150 ký tự';
        }
    }

    if(empty($category)){
        $errors['category'] = 'Danh mục không được để trống';
    }

    if(empty($oldPrice)){
       $oldPrice = 0;
    }else {
        $oldPrice = str_replace(',','',$oldPrice);
        $oldPrice = str_replace('.','',$oldPrice);
        if(!is_numeric($oldPrice || $oldPrice < 0)){
            $errors['oldPrice'] = 'Giá không hợp lệ';
        }
    }

    if(empty($newPrice)){
        $errors['newPrice'] = 'Giá bán không được để trống';
    }else {
        $newPrice = str_replace(',','',$newPrice);
        $newPrice = str_replace('.','',$newPrice);
        if(!is_numeric($newPrice) || $newPrice < 0){
            $errors['newPrice'] = 'Giá bán không hợp lệ';
        }
    }

    if(empty($discount)){
        $discount = 0;
    }else {
        if(!is_numeric($discount) || $discount < 0 || $discount > 100){
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
        $errors['images'] = 'Thêm ảnh';
    }
    
    if(empty($errors)){
        $slug = toSlug($name);
        global $conn;

        if(isset($sizes)){
            $sql = "INSERT INTO products(category_id,name,oldPrice,newPrice,discount,
                    quantity,description,color,sizes,images,is_new,is_popular,slug)
                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $result = query($sql,[$category,$name,$oldPrice,$newPrice,
            $discount,$quantity,$description,$color,$sizes,$images,$is_new,$is_popular,$slug]);

            $conn = null;
        }else {
            $sql = "INSERT INTO products(category_id,name,oldPrice,newPrice,discount,
                    quantity,description,color,images,is_new,is_popular,slug)
                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
            $result = query($sql,[$category,$name,$oldPrice,$newPrice,
            $discount,$quantity,$description,$color,$images,$is_new,$is_popular,$slug]);

            $conn = null;
        }

        if($result->rowCount() > 0){
            $success = 'Thêm sản phẩm thành công';
            $name='';
            $category='';
            $oldPrice='';
            $newPrice='';
            $discount='';
            $quantity='';
            $color='';
            $description='';
        }else {
            $errors = 'Thêm sản phẩm thất bại vui lòng thử lại';
        }
    }
}