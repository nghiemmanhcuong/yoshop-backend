<?php

if(isset($_GET['customer_id'])){
    $customer_id = $_GET['customer_id'];
    $sql = "DELETE FROM users WHERE id=?";
    $result = query($sql,[$customer_id]);

    if($result->rowCount() > 0){
        redirect(WEB_ROOT.'/customer?msg=Xoá khách hàng thành công');
    }else {
        redirect(WEB_ROOT.'/customer');
    }
}else {
    redirect(WEB_ROOT.'/customer');
}