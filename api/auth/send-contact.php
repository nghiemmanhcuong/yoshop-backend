<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

require_once('../config/db_conn.php');
require_once('../models/Auth.php');

$database = new Database();
$conn = $database->connect();

$auth = new Auth($conn);

$data = json_decode(file_get_contents('php://input'));

$result = $auth->sendContact($data);

echo json_encode($result);