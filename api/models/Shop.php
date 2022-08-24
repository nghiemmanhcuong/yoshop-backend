<?php

class Shop {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getBanners() {
        $sql = "SELECT * FROM banners WHERE status=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([1]);
        
        return $stmt;
    }

    public function getShopInfo() {
        $sql = "SELECT * FROM shop_info";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $shop_info = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount() > 0) {
            return $shop_info;
        }else {
            return [];
        }
    }

    public function getPoll() {
        $sql = "SELECT * FROM poll";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $poll = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount() > 0) {
            return $poll;
        }else {
            return [];
        }
    }

    public function votedPoll($choose_voted=null) {
        if(isset($choose_voted)){
            $choose_voted = (int)$choose_voted;

            switch ($choose_voted) {
                case 1:
                    $sql = "UPDATE poll SET voted_answer_one=voted_answer_one+1";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute();

                    if($stmt->rowCount() > 0) {
                        return [
                            "voted"=>1,
                            "message"=>"Bình chọn thành công cảm ơn bạn đã bình chọn giúp chúng tôi!!!",
                            'success'=>true,
                        ];
                    }else {
                        return [
                            "message"=>"Lỗi khi thực hiện update voted",
                            'success'=>false,
                        ];
                    }
                    break;

                case 2:
                    $sql = "UPDATE poll SET voted_answer_two=voted_answer_two+1";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute();

                    if($stmt->rowCount() > 0) {
                        return [
                            "voted"=>2,
                            "message"=>"Bình chọn thành công cảm ơn bạn đã bình chọn giúp chúng tôi!!!",
                            'success'=>true,
                        ];
                    }else {
                        return [
                            "message"=>"Lỗi khi thực hiện update voted",
                            'success'=>false,
                        ];
                    }
                    break;

                case 3:
                    $sql = "UPDATE poll SET voted_answer_three=voted_answer_three+1";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute();

                    if($stmt->rowCount() > 0) {
                        return [
                            "voted"=>3,
                            "message"=>"Bình chọn thành công cảm ơn bạn đã bình chọn giúp chúng tôi!!!",
                            'success'=>true,
                        ];
                    }else {
                        return [
                            "message"=>"Lỗi khi thực hiện update voted",
                            'success'=>false,
                        ];
                    }
                    break;

                case 4:
                    $sql = "UPDATE poll SET voted_answer_four=voted_answer_four+1";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute();

                    if($stmt->rowCount() > 0) {
                        return [
                            "voted"=>4,
                            "message"=>"Bình chọn thành công cảm ơn bạn đã bình chọn giúp chúng tôi!!!",
                            'success'=>true,
                        ];
                    }else {
                        return [
                            "message"=>"Lỗi khi thực hiện update voted",
                            'success'=>false,
                        ];
                    }
                    break;
                
                default:
                    return [
                        "message"=>"Lỗi khi thực hiện update voted",
                        'success'=>false,
                    ];
                    break;
            }
        }else {
            return [
                "message"=>"Lỗi khi thực hiện update voted",
                'success'=>false,
            ];
        }
    }
}