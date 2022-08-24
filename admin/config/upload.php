<?php

if(isset($_FILES['upload']['name'])){
    $file = $_FILES['upload']['name'];
    $file_tmp = $_FILES['upload']['tmp_name'];

    $ext = strtolower(pathinfo($file,PATHINFO_EXTENSION));
    $new_file = md5(uniqid()).'.'.$ext;

    move_uploaded_file($file_tmp, '../../files/'.$new_file);
    $function_number=$_GET['CKEditorFuncNum'];
    $url='../../files/'.$new_file;
    $message='';
    echo "<script>window.parent.CKEDITOR.tools.callFunction('".$function_number."','".$url."','".$message."')</script>";
}

?>