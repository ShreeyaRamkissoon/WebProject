<?php 

    if(isset($_POST)){
        include 'db_connect.php';

        $product_id = $_POST['prod_id'];
        //echo "from Ajax ".$product_id;
        $query =   "SELECT customer.fname, p.comment,p.rating,p.date
                    FROM prod_reviews p
                    LEFT JOIN customer ON customer.cust_id = p.cust_id
                    WHERE prod_id = $product_id;";

        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $result = $conn->query($query);

        $array_result = $result->fetchAll(PDO::FETCH_ASSOC);
    
        //var_dump($array_result);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($array_result,JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);

    }


?>