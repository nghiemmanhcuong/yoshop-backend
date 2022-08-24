<?php
session_start();
define('DIR_ROOT',__DIR__);

date_default_timezone_set('Asia/Ho_Chi_Minh');

if(!empty($_SERVER['https']) && $_SERVER['https'] = 'on'){
    $web_root = 'https://'.$_SERVER['HTTP_HOST'];
}else {
    $web_root = 'http://'.$_SERVER['HTTP_HOST'];
}
$folder = str_replace($_SERVER['DOCUMENT_ROOT'],'',DIR_ROOT);

define('WEB_ROOT',$web_root.$folder);
define('IMG_ROOT',str_replace('admin','files/',WEB_ROOT));

require_once('config/db_conn.php');
require_once('config/functions.php');
require_once('controllers/index.php');