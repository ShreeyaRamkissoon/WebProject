<?php 
    include 'db_connect.php';
    $Query = "SELECT category_id,cname FROM Category";
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     $result = $conn->query($Query);

    $array_result = $result->fetchAll(PDO::FETCH_ASSOC);
    
     //var_dump($array_result);
     header('Content-Type: application/json; charset=utf-8');
    echo json_encode($array_result,JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);
?>