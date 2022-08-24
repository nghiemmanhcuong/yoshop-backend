<?php
if(!checkManagers('orders',$_SESSION['user']['managers'])){
    redirect(WEB_ROOT . '/404.php');
}

if(!empty($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $sql = "SELECT * FROM orders WHERE id=?";
    $order = query($sql,[$order_id])->fetch(PDO::FETCH_ASSOC);

    if($order['discount'] > 0) {
        $price_discount = ($order['total_price'] * $order['discount']) / 100;
        $total_amount_payable = $order['total_price'] - $price_discount;
        $total_amount_payable += $order['transport_fee'];
    }else {
        $total_amount_payable = $order['total_price'] + $order['transport_fee'];
    }

    $sql = "SELECT p.name,p.images,p.color,ord.size,ord.quantity 
            FROM order_detail as ord INNER JOIN products as p ON ord.product_id=p.id
            WHERE ord.order_id=?";

    $order_detail = query($sql,[$order_id])->fetchAll(PDO::FETCH_ASSOC);
}else {
    redirect(WEB_ROOT . '/order');
}

