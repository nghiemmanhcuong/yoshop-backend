<?php
function handleImport($view=null,$model=null,$web_title=''){
    if(!isset($_SESSION['user']) || ($_SESSION['user']['access'] != 'admin' && $_SESSION['user']['access'] != 'saff')){
        redirect(WEB_ROOT);
    }
    require_once('config/variables.php');
    if(!empty($model)){
        require_once('models/'.$model);
    }
    include_once('views/block/header.php');
    if(!empty($view)){
        require_once('views/'.$view);
    }
    include_once('views/block/footer.php');
}

function query($sql,$params=[]) {
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    
    return $stmt;
}

function redirect($path){
    return header('Location:'.$path);
}

function validateInput($input){
    $input = trim($input);
    $input = htmlspecialchars($input);
    $input = strip_tags($input);

    return $input;
}

function toSlug($str) {
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/("|\'|\.)/', '', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9\-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}

function handleUpload($file) {
    $file_name = $file['name'];
    $max_size = 10;
    $ext_arr = ['png','jpg','jpeg','webp'];

    $error = '';
    $file_size = $file['size']/1024/1024;
    $ext = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
    $new_file = md5(uniqid()).'.'.$ext;
    
    if(in_array($ext,$ext_arr)){
        if($file_size <= $max_size){
            $upload = move_uploaded_file($file['tmp_name'],'../files/'.$new_file);
            if(!$upload){
                $error = 'Tải ảnh không thành công';
            }
        }else {
            $error = 'File vượt quá dung lượng';
        }
    }else {
        $error = 'File không hợp lệ';
    }
    
    return [
        'file'=>$new_file,
        'error'=>$error
    ];
}

function handleUploadMultiple($files) {
    $file_name_arr = $files['name'];
    $max_size = 10;
    $ext_arr = ['png','jpg','jpeg','webp'];

    $errors = [];
    $new_file_arr = [];

    if(!empty($file_name_arr)){
        foreach ($file_name_arr as $key=>$item) {
            $size = $files['size'][$key]/1024/1024;
            $ext = strtolower(pathinfo($item,PATHINFO_EXTENSION));
            $new_file = md5(uniqid()).'.'.$ext;
            
            if(in_array($ext,$ext_arr)){

                if($size <= $max_size){
                    $upload = move_uploaded_file($files['tmp_name'][$key],'../files/'.$new_file);
                    $new_file_arr[] = $new_file;
                }else {
                    $errors[] = 'File '.($key + 1).' vượt quá dung lượng ';
                }
            }else {
                $errors[] = 'File '.($key + 1).' không hợp lệ';
            }
        }
    }

    return [
        'errors' => $errors,
        'files' => $new_file_arr
    ];
}

function handlePrice($price) {
    $price = number_format($price,0,',','.');
    return $price.'<sup>đ</sup>';
}

function getCategoryName($category_id) {
    global $conn;

    if($category_id == 0) {
        return 'Sản phẩm chưa có loại';
    }else {
        $sql = "SELECT name FROM categories WHERE id=?";
        $category = query($sql,[$category_id])->fetch(PDO::FETCH_ASSOC);
        return $category['name'];
    }
}

function getTotalComments($product_id) {
    global $conn;
    $sql = "SELECT * FROM product_comments WHERE product_id=?";
    $comment_count = query($sql,[$product_id])->rowCount();

    return $comment_count;
}

function getLatestComment($product_id) {
    global $conn;
    $sql = "SELECT created_at FROM product_comments WHERE product_id=? ORDER BY created_at DESC LIMIT 1";
    $latest_comment = query($sql,[$product_id])->fetch(PDO::FETCH_ASSOC);

    if(isset($latest_comment['created_at'])){
        return $latest_comment['created_at'];
    }else {
        return null;
    }
}

function getOldestComment($product_id) {
    global $conn;
    $sql = "SELECT created_at FROM product_comments WHERE product_id=? ORDER BY created_at ASC LIMIT 1";
    $oldest_comment = query($sql,[$product_id])->fetch(PDO::FETCH_ASSOC);

    if(isset($oldest_comment['created_at'])){
        return $oldest_comment['created_at'];
    }else {
        return null;
    }
}

function checkManagers($function='',$managers=[]){
    if(!isset($function) || !isset($managers)){
        return false;
    }else {
        if(in_array($function,$managers)){
            return true;
        }
    }
    return false;
}

function getTotalProductByCategory($category_id){
    global $conn;
    $sql = "SELECT * FROM products WHERE category_id=?";
    $total = query($sql,[$category_id])->rowCount();
    return $total;
}

function getTotalSales($date){
    global $conn;
    $date = explode("-",$date);
    $year = $date[0];
    $month = $date[1];

    $sql = "SELECT sum(total_price) as total_price FROM orders WHERE  year(created_at)=? AND month(created_at)=? AND status='Đã thanh toán'";
    $result = query($sql,[$year,$month])->fetch(PDO::FETCH_ASSOC);
    return $result['total_price'];
}

function getTotalSalesDay($date){
    global $conn;
    $date = explode("-",$date);
    $year = $date[0];
    $month = $date[1];
    $day = $date[2];

    $sql = "SELECT sum(total_price) as total_price FROM orders WHERE  year(created_at)=? AND month(created_at)=? AND day(created_at)=? AND status='Đã thanh toán'";
    $result = query($sql,[$year,$month,$day])->fetch(PDO::FETCH_ASSOC);
    return $result['total_price'];
}

function getTotalCustomerRegister($date){
    global $conn;
    $date = explode("-",$date);
    $year = $date[0];
    $month = $date[1];

    $sql = "SELECT id FROM users WHERE  year(created_at)=? AND month(created_at)=? AND access='user'";
    $result = query($sql,[$year,$month])->rowCount();
    return $result;
}
