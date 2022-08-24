<?php

class Auth {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCurrentUser($user_email=null) {
        if(isset($user_email)) {
            $sql= "SELECT id,surname,name,email,phone,access FROM users WHERE email=?";
            $stmt= $this->conn->prepare($sql);
            $stmt->execute([$user_email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($stmt->rowCount() > 0){
                return [
                    'data' => $user,
                    'success' => true,
                ];
            }else {
                return [
                    'success' => false,
                    'message' => 'Lấy người dùng thất bại',
                ];
            }

        }else {
            return [
                'success' => false,
                'message' => 'Lấy người dùng thất bại',
            ];
        }
    }

    public function updateUser($data = null){
        if(isset($data)) {
            $sql = 'UPDATE users SET surname=?, name=?, email=?, phone=? WHERE id=?';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $data->surname,
                $data->name,
                $data->email,
                $data->phone,
                $data->id,
            ]);

            if($stmt->rowCount() > 0){
                return [
                    'success' => true,
                    'data'=> $data,
                    'message' => 'Thay đổi thông tin thành công'
                ];
            }else {
                return [
                    'success' => false,
                    'message' => 'Thay đổi thông tin thất bại'
                ];
            }

        }else {
            return [
                'success' => false,
                'message' => 'Thay đổi thông tin thất bại'
            ];
        }
    }

    public function register($data=null) {
        if(isset($data)) {
            $sql = "SELECT name FROM users WHERE email=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$data->email]);

            if($stmt->rowCount() > 0) {
                return [
                    'success' => false,
                    'message' => 'Email đã được sử dụng vui lòng chọn email khác',
                ];
            }else {
                $satl_password = password_hash($data->password,PASSWORD_BCRYPT,array('cost' => 11));

                $sql = "INSERT INTO users(surname,name,email,phone,password,sex) VALUES (?,?,?,?,?,?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    $data->surname,
                    $data->name,
                    $data->email,
                    $data->phone,
                    $satl_password,
                    $data->sex
                ]);

                $userId = $this->conn->lastInsertId();
                if($stmt->rowCount() > 0) {
                    return [
                        'userId' => $userId,
                        'success' => true,
                        'message' => 'Đăng ký tài khoản thành công',
                    ];
                }else {
                    return [
                        'success' => false,
                        'message' => 'Đăng ký không thành công',
                    ];
                }
            }

        }else {
            return [
                'success' => false,
                'message' => 'Đăng ký không thành công',
            ];
        }
    }

    public function login($data = null) {

        if(isset($data)){
            $sql = "SELECT id,surname,name,email,access,password FROM users WHERE email=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$data->email]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user){
                if(password_verify($data->password,$user['password'])){
                    $result_user = [
                        'userId' => $user['id'],
                        'surname' => $user['surname'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'access' => $user['access'],
                    ];

                    return [
                        'success' => true,
                        'data' => $result_user
                    ];

                }else {
                    return [
                        'success' => false,
                        'message' => 'Tài khoản hoặc mật khẩu không chính xác',
                    ];
                }
            }else {
                return [
                    'success' => false,
                    'message' => 'Tài khoản hoặc mật khẩu không chính xác',
                ];
            }

        }else {
            return [
                'success' => false,
                'message' => 'Đăng nhập không thành công',
            ];
        }
    }

    public function changePassword($data = null){
        if(isset($data)){
            if($data->newPassword != $data->retypePassword){
                return [
                    'success' => false,
                    'message' => 'Mật khẩu nhập lại không khớp',
                ];
            }else {
                $sql = "SELECT password FROM users WHERE email=?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$data->email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if($user && password_verify($data->oldPassword,$user['password'])){
                    $hash_password = password_hash($data->newPassword,PASSWORD_BCRYPT,array('cost'=> 11));
                    $sql = "UPDATE users SET password=? WHERE email=?";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute([$hash_password,$data->email]);

                    if($stmt->rowCount() > 0){
                        return [
                            'success' => true,
                            'message' => 'Đổi mật khẩu thành công',
                        ];
                    }else {
                        return [
                            'success' => false,
                            'message' => 'Đổi mật khẩu không thành công',
                        ];
                    }

                }else {
                    return [
                        'success' => false,
                        'message' => 'Email hoặc mật khẩu không chính xác',
                    ];
                }

            }

        }else {
            return [
                'success' => false,
                'message' => 'Đổi mật khẩu không thành công',
            ];
        }
    }

    public function addAddress($data=null) {
        if(isset($data)){
            $sql = "INSERT INTO user_addresses(user_id,surname,name,company,address,contry,province,phone)
                    VALUES(?,?,?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $data->userId,
                $data->surname,
                $data->name,
                $data->company,
                $data->address,
                $data->contry,
                $data->province,
                $data->phone,
            ]);

            if($stmt->rowCount() > 0){
                return [
                    'success' => true,
                    'message' => 'Thêm địa chỉ thành công',
                ];
            }else {
                return [
                    'success' => false,
                    'message' => 'Thêm địa chỉ không thành công',
                ];
            }

        }else {
            return [
                'success' => false,
                'message' => 'Thêm địa chỉ không thành công',
            ];
        }
    }

    public function getUserAddress($userId=null){
        if(isset($userId)){
            $sql = "SELECT * FROM user_addresses WHERE user_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$userId]);

            if($stmt->rowCount() > 0){
                $user_addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return [
                    'success' => true,
                    'user_addresses' => $user_addresses
                ];
                
            }else {
                return [
                    'success' => false,
                    'message' => 'Có lỗi khi thực hiện lấy địa chỉ người dùng',
                ];
            }

        }else {
            return [
                'success' => false,
                'message' => 'Có lỗi khi thực hiện lấy địa chỉ người dùng',
            ];
        }
    }

    public function deleteUserAddress($user_addresses_id=null){
        if(isset($user_addresses_id)){
            $sql = "DELETE FROM user_addresses WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user_addresses_id]);

            return [
                'success' => true,
                'message' => 'Xoá địa chỉ người dùng thành công',
            ];

        }else {
            return [
                'success' => false,
                'message' => 'Có lỗi khi thực hiện xoá địa chỉ người dùng',
            ];
        }
    }

    public function sendContact($data = null){
        if(isset($data)){
            $sql = "INSERT INTO contacts(customer_name,customer_email,customer_phone,title,content) VALUES(?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $data->name,
                $data->email,
                $data->phone,
                $data->title,
                $data->content,
            ]);

            if($stmt->rowCount() > 0){
                return [
                    'success' => true,
                    'message' => 'Gửi liên hệ thành công chúng tôi sẽ trả lời bạn trong thời gian sớm nhất',
                ];
            }else {
                return [
                    'success' => false,
                    'message' => 'Có lỗi khi thực hiện gửi liên hệ vui lòng liên hệ quản trị viên',
                ];
            }

        }else{
            return [
                'success' => false,
                'message' => 'Có lỗi khi thực hiện gửi liên hệ vui lòng liên hệ quản trị viên',
            ];
        }
    }

    // destroy Order
    public function destroyOrder($order_id = null){
        if(isset($order_id)){
            $sql = "UPDATE orders SET status=? WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['Đã huỷ',$order_id]);

            if($stmt->rowCount() > 0){
                return [
                    'success' => true,
                    'message' => 'Huỷ đơn hàng thành công'
                ];
            }else {
                return [
                    'success' => false,
                    'message' => 'Huỷ đơn hàng thất bại'
                ];
            }

        }else {
            return [
                'success' => false,
                'message' => 'Huỷ đơn hàng thất bại'
            ];
        }
    }

    // get Orders
    public function getOrders($user_id = null) {
        if(isset($user_id)){
            $sql = "SELECT id,customer_address,total_price,status,created_at 
                    FROM orders WHERE user_id=? AND NOT status=? AND NOT status=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user_id,'Đã thanh toán','Đã huỷ']);

            if($stmt->rowCount() > 0){
                $data = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
        
                    $order_item = [
                        'id' => $row['id'],
                        'customer_address' => $row['customer_address'],
                        'total_price' => $row['total_price'],
                        'status' => $row['status'],
                        'created_at' => $row['created_at']
                    ];

                    array_push($data, $order_item);
                }
                return [
                    'success' => true,
                    'data' => $data
                ];

            }else {
                return [
                    'success' => true,
                    'data' => []
                ];
            }
        }else {
            return [
                'success' => false,
                'message' => 'Lấy đơn hàng thất bại'
            ];
        }
    }
}