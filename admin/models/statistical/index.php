<?php

$sql = "SELECT * FROM products";
$count_products = query($sql)->rowCount();

$sql = "SELECT * FROM blogs";
$count_blogs = query($sql)->rowCount();

$sql = "SELECT name FROM users WHERE access='user'";
$count_customers = query($sql)->rowCount();

$sql = "SELECT name FROM users WHERE access='admin' OR access='saff'";
$count_admin = query($sql)->rowCount();

$sql = "SELECT categories.name, COUNT(products.id) AS product_number 
        FROM categories LEFT JOIN products ON categories.id = products.category_id 
        GROUP BY categories.name;";
$categories = query($sql)->fetchAll(PDO::FETCH_ASSOC);

// sales
$date_sales = array();
$sales_data = array();

if(isset($_GET['sales'])){
    $time = $_GET['sales'];

    if($time == 'six_months') {
        for ($i=0; $i <= 5; $i++) {
            array_push($date_sales,date("Y-m",strtotime("-".$i." months")));
        }
        
        foreach ($date_sales as $item) {
            $totalPrice = getTotalSales($item) ?? 0;
            $sales_item = [
                'year'=>$item,
                'value'=> $totalPrice
            ];
            array_push($sales_data,$sales_item);
        }
    }else if($time == 'most_recent_month'){
        for ($i=0; $i <= 29; $i++) {
            array_push($date_sales,date("Y-m-d",strtotime("-".$i." day")));
        }
        
        foreach ($date_sales as $item) {
            $totalPrice = getTotalSalesDay($item) ?? 0;
            $sales_item = [
                'year'=>$item,
                'value'=> $totalPrice
            ];
            array_push($sales_data,$sales_item);
        }
    }else if($time == 'week_past'){
        for ($i=0; $i <= 6; $i++) {
            array_push($date_sales,date("Y-m-d",strtotime("-".$i." day")));
        }
        
        foreach ($date_sales as $item) {
            $totalPrice = getTotalSalesDay($item) ?? 0;
            $sales_item = [
                'year'=>$item,
                'value'=> $totalPrice
            ];
            array_push($sales_data,$sales_item);
        }
    }else {
        for ($i=0; $i <= 11; $i++) {
            array_push($date_sales,date("Y-m",strtotime("-".$i." months")));
        }
        
        foreach ($date_sales as $item) {
            $totalPrice = getTotalSales($item) ?? 0;
            $sales_item = [
                'year'=>$item,
                'value'=> $totalPrice
            ];
            array_push($sales_data,$sales_item);
        }
    }

}else {
    for ($i=0; $i <= 11; $i++) {
        array_push($date_sales,date("Y-m",strtotime("-".$i." months")));
    }
    
    foreach ($date_sales as $item) {
        $totalPrice = getTotalSales($item) ?? 0;
        $sales_item = [
            'year'=>$item,
            'value'=> $totalPrice
        ];
        array_push($sales_data,$sales_item);
    }
}

// customers
// sales
$date_customers = array();
$customers_data = array();
for ($i=0; $i <= 4; $i++) {
    array_push($date_customers,date("Y-m",strtotime("-".$i." months")));
}

foreach ($date_customers as $item) {
    $totalCustomer = getTotalCustomerRegister($item) ?? 0;
    $customers_item = [
        'year'=>$item,
        'value'=> $totalCustomer
    ];
    array_push($customers_data,$customers_item);
}