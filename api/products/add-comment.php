<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

require_once('../config/db_conn.php');
require_once('../models/Products.php');

$database = new Database();
$connect = $database->connect();

$products = new Products($connect);

$dataInput = json_decode(file_get_contents('php://input'));

$result = $products->addComment($dataInput);

echo json_encode($result);