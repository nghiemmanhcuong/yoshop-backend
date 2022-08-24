<?php

$limit = 13;
$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($curr_page - 1) * $limit;

$sql = "SELECT * FROM contacts ORDER BY id DESC LIMIT $limit OFFSET $offset";
$contacts = query($sql)->fetchAll(PDO::FETCH_ASSOC);

$contact_count = query("SELECT * FROM contacts")->rowCount();
$pages = ceil($contact_count / $limit);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(isset($_POST['chooseRows'])){
        $chooseRowId = $_POST['chooseRows'];
    }else {
        $error = 'Bạn chưa chọn bản ghi nào';
    }

    if(!isset($error)){
        $check = true;
        $sql = "DELETE FROM contacts WHERE id=?";
        foreach ($chooseRowId as $id) {
            $result = query($sql,[$id]);
            if($result->rowCount() == 0) {
                $check = false;
            }
        }

        if($check) {
            redirect(WEB_ROOT . '/contact?msg=Xoá tất cả bản ghi đã chọn thành công');
        }else {
            $error = 'Xoá tất cả bản ghi thất bại';
        }
    }
}