<?php

class Checkouts {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function handeCheckouts($data=null) {
        if(isset($data)) {
            
            if(isset($data->userInfo->userId)){
                $sql = "INSERT INTO orders(user_id,customer_name,customer_phone,customer_email,
                customer_address,total_price,payment_method,message,discount,transport_fee) VALUES(?,?,?,?,?,?,?,?,?,?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    (int)$data->userInfo->userId,
                    $data->userInfo->customerName,
                    $data->userInfo->customerPhone,
                    $data->userInfo->customerEmail,
                    $data->userInfo->customerAddress,
                    $data->userInfo->totalPrice,
                    $data->userInfo->paymentMethod,
                    $data->userInfo->message,
                    $data->userInfo->discount,
                    $data->userInfo->transportFee,
                ]);
            }else {
                $sql = "INSERT INTO orders(customer_name,customer_phone,customer_email,
                customer_address,total_price,payment_method,message,discount,transport_fee) VALUES(?,?,?,?,?,?,?,?,?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    $data->userInfo->customerName,
                    $data->userInfo->customerPhone,
                    $data->userInfo->customerEmail,
                    $data->userInfo->customerAddress,
                    $data->userInfo->totalPrice,
                    $data->userInfo->paymentMethod,
                    $data->userInfo->message,
                    $data->userInfo->discount,
                    $data->userInfo->transportFee,
                ]);
            }

            if($stmt->rowCount() > 0) {
                $check = true;
                $order_id = $this->conn->lastInsertId();
                $sql_update_quantity = "UPDATE products SET quantity = quantity-? WHERE id=?";
                $sql = "INSERT INTO order_detail(order_id,product_id,size,quantity) VALUES(?,?,?,?)";
                foreach ($data->cartProducts as $item) {
                    $stmt_update_quantity = $this->conn->prepare($sql_update_quantity);
                    $stmt_update_quantity->execute([
                        $item->quantity,
                        $item->productId
                    ]);
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute([
                        $order_id,
                        $item->productId,
                        $item->size,
                        $item->quantity
                    ]);

                    if($stmt->rowCount() <= 0 || $stmt_update_quantity->rowCount() <= 0) {
                        $check = false;
                    }
                }

                if($check){
                    return [
                        'success'=>true,
                        'message'=>'Đặt hàng thành công',
                    ];
                }else {
                    return [
                        'success'=>false,
                        'message'=>'Đặt hành không thành công vui lòng kiểm tra lại thông tin hoặc liên hệ quản trị viên',
                    ];
                }

            }else {
                return [
                    'success'=>false,
                    'message'=>'Đặt hành không thành công vui lòng kiểm tra lại thông tin hoặc liên hệ quản trị viên',
                ];
            }

        }else {
            return [
                'success'=>false,
                'message'=>'Đặt hành không thành công vui lòng kiểm tra lại thông tin hoặc liên hệ quản trị viên',
            ];
        }
    }
}