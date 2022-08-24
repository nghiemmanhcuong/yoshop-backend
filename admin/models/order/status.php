<?php

if(!checkManagers('orders',$_SESSION['user']['managers'])){
    redirect(WEB_ROOT . '/404.php');
}

if(!empty($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $sql = "SELECT id,status,customer_name,customer_phone FROM orders WHERE id=?";
    $order = query($sql,[$order_id])->fetch(PDO::FETCH_ASSOC);
}else {
    redirect(WEB_ROOT . '/order');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $status = validateInput($_POST['status']);
    $id = validateInput($_POST['id']);

    $sql = "UPDATE orders SET status=? WHERE id=?";
    $result = query($sql,[$status,$id]);

    if($result->rowCount() > 0){        
        if($status == 'Đã thanh toán'){
            $sql = "SELECT product_id,quantity FROM order_detail WHERE order_id=?";
            $order_details = query($sql,[$id])->fetchAll(PDO::FETCH_ASSOC);

            $sql_update_quantity_product = "UPDATE products SET quantity=quantity-? WHERE id=?";
            $sql_update_sold_product = "UPDATE products SET sold=sold+? WHERE id=?";
            $check = true;
            foreach ($order_details as $item) {
                $result_sold = query($sql_update_sold_product,[$item['quantity'],$item['product_id']]);
                $result_quantity = query($sql_update_quantity_product,[$item['quantity'],$item['product_id']]);
                if($result_quantity->rowCount() == 0){
                    $check = false;
                    break;
                }

                if($result_sold->rowCount() == 0){
                    $check = false;
                    break;
                }
            }

            if(!$check){
                $error = 'Lỗi khi update số lượng sản phẩm vui lòng liên hệ quan trị viên';
            }else {
                redirect(WEB_ROOT . '/order?msg=Sửa trạng thái đơn hàng thành cồng');
            }
        }else {
            redirect(WEB_ROOT . '/order?msg=Sửa trạng thái đơn hàng thành cồng');
        }
    }else {
        $error = 'Lỗi khi sửa trạng thái đơn hàng vui lòng liên hệ quan trị viên';
    }
}