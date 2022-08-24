<?php

$sql = "SELECT * FROM poll";
$poll = query($sql)->fetch(PDO::FETCH_ASSOC);
$total_voted = $poll['voted_answer_one'] + $poll['voted_answer_two'] + $poll['voted_answer_three'] + $poll['voted_answer_four'];

if($poll['voted_answer_one'] > 0) {
    $percentage_answer_one = ($poll['voted_answer_one'] / $total_voted) * 100;
    $percentage_answer_one = round($percentage_answer_one,0);
}else {
    $percentage_answer_one = 0;
}

if($poll['voted_answer_two'] > 0) {
    $percentage_answer_two = ($poll['voted_answer_two'] / $total_voted) * 100;
    $percentage_answer_two = round($percentage_answer_two,0);
}else {
    $percentage_answer_two = 0;
}

if($poll['voted_answer_three'] > 0) {
    $percentage_answer_three = ($poll['voted_answer_three'] / $total_voted) * 100;
    $percentage_answer_three = round($percentage_answer_three,0);
}else {
    $percentage_answer_three = 0;
}

if($poll['voted_answer_four'] > 0) {
    $percentage_answer_four = ($poll['voted_answer_four'] / $total_voted) * 100;
    $percentage_answer_four = round($percentage_answer_four,0);
}else {
    $percentage_answer_four = 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();

    $start_day = validateInput($_POST['start_day']);
    $end_day = validateInput($_POST['end_day']);
    $start_hours = validateInput($_POST['start_hours']);
    $end_hours = validateInput($_POST['end_hours']);
    $start_minute = validateInput($_POST['start_minute']);
    $end_minute = validateInput($_POST['end_minute']);
    $content_poll = validateInput($_POST['content_poll']);
    $answer_one = validateInput($_POST['answer_one']);
    $answer_two = validateInput($_POST['answer_two']);
    $answer_three = validateInput($_POST['answer_three']);
    $answer_four = validateInput($_POST['answer_four']);

    if(empty($start_day)){
        $errors['start_day'] = 'Nhập ngày bắt đầu thằm dò ý kiến';
    }

    if(empty($end_day)){
        $errors['end_day'] = 'Nhập ngày kết thúc thằm dò ý kiến';
    }

    if(empty($content_poll)){
        $errors['content_poll'] = 'Nhập nội dung thằm dò ý kiến';
    }

    if(empty($answer_one)){
        $errors['answer_one'] = 'Nhập câu trả lời thứ nhất';
    }

    if(empty($answer_two)){
        $errors['answer_two'] = 'Nhập câu trả lời thứ hai';
    }

    if(empty($answer_three)){
        $errors['answer_three'] = 'Nhập câu trả lời thứ ba';
    }

    if(empty($answer_four)){
        $errors['answer_four'] = 'Nhập câu trả lời thứ tư';
    }

    if(isset($_POST['reset_voted_points'])){
        $reset_voted_points = true;
    }else {
        $reset_voted_points = false;
    }

    if(empty($errors)){
        $sql = "UPDATE poll SET start_day=?,end_day=?,start_hours=?,end_hours=?,
                    start_minute=?,end_minute=?,content=?,answer_one=?,answer_two=?,answer_three=?,answer_four=?";
        $result = query($sql,[
            $start_day,
            $end_day,
            $start_hours,
            $end_hours,
            $start_minute,
            $end_minute,
            $content_poll,
            $answer_one,
            $answer_two,
            $answer_three,
            $answer_four
        ]);

        if($result->rowCount() > 0){
            if($reset_voted_points){
                $sql = "UPDATE poll SET voted_answer_one=0,voted_answer_two=0,voted_answer_three=0,voted_answer_four=0";
                $result = query($sql);
                if($result->rowCount() > 0){
                    redirect(WEB_ROOT . '/system/probe?msg=Thay đổi thăm dò ý kiến thành công');
                }
            }else {
                redirect(WEB_ROOT . '/system/probe?msg=Thay đổi thăm dò ý kiến thành công');
            }
        }
    }
}