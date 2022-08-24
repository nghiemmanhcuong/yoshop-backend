<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

require_once('../config/db_conn.php');
require_once('../models/Auth.php');

$database = new Database();
$connect = $database->connect();

$auth = new Auth($connect);

$data = json_decode(file_get_contents('php://input'));

$result = $auth->register($data);

echo json_encode($result);