<?php

if(!checkManagers('contacts',$_SESSION['user']['managers'])){
    redirect(WEB_ROOT . '/404.php');
}

if(!empty($_GET['contact_id'])){
    $contact_id = $_GET['contact_id'];
    $sql = "SELECT * FROM contacts WHERE id=?";
    $contact = query($sql,[$contact_id])->fetch(PDO::FETCH_ASSOC);

    if(!$contact){
        redirect(WEB_ROOT . '/contact');
    }
}else {
    redirect(WEB_ROOT . '/contact');
}