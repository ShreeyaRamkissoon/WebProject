<?php 

    if(isset($_POST)){

        require 'db_connect.php';

        $prod_name = $_POST['imgName'];
        $img = "";

        $Query = "SELECT * FROM product ";
        //echo $Query;
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $aresult = $conn->query($Query);

        
       while ($array_result = $aresult->fetch(PDO::FETCH_ASSOC)) {
           if($array_result['pname'] == $prod_name){
                $img = $array_result['image'];
           }
       }    
    
       echo $img;
      
       // header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($array_result,JSON_PRETTY_PRINT);
        //print_r( $driverData);
    }


?>