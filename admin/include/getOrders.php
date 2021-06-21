<?php 
    include 'db_connect.php';
    $Query =    "SELECT customer.fname, customer.lname,o.cust_id, o.date_purchase,product.pname,product.image 
                FROM orders2 o
                LEFT JOIN customer on customer.cust_id = o.cust_id
                LEFT JOIN product on product.prod_id = o.prod_id
                LEFT JOIN driver on driver.driver_id = o.driver_id";
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     $result = $conn->query($Query);

    $array_result = $result->fetchAll(PDO::FETCH_ASSOC);
    
     //var_dump($array_result);
     header('Content-Type: application/json; charset=utf-8');
    echo json_encode($array_result,JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);
?>