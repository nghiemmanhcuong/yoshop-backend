<?php
define('DB_HOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','shopyo8');

// define('DB_HOST','sql100.byethost7.com');
// define('DB_USERNAME','b7_31693023');
// define('DB_PASSWORD','0987954221');
// define('DB_NAME','b7_31693023_yoshop');

try {
    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",DB_USERNAME,DB_PASSWORD);
} catch (PDOException $e) {
    echo "Error: ".$e->getMessage();
    die();
}