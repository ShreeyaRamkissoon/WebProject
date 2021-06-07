<?php 
    //echo "Inside Ajax";


    if(isset($_POST)){
        $prod_ID = $_POST['product_id'];
        $comment = $_POST['comment'];
        $comment = filter_var($comment,  FILTER_SANITIZE_STRING); //Remove any codes that may harm Database
        $custID = $_POST['cust_id'];
        $rating = $_POST['rating'];
        $date = date('y-m-d');

        //echo $prod_ID." ".$comment." ".$rating;
        $errComment = "";
        $errRating = "";

        if(empty($comment)){
            $errComment = "ERROR: You have not entered any Comment<br>";    
        }
        if(empty($rating)){
            $errRating = "ERROR: You Have not Selected Any rating Options<br>";    
        }

        if(empty($errRating) && empty($errComment)){
            require_once 'db_connect.php';
            $errQuery1 ="";
            $errQuery2 = "";

            //Add in prod_review Table
            //$sInsert = 'INSERT INTO prod_reviews(prod_id,cust_id,comment,rating,date,flagged,banned) VALUES ('.$prod_ID.','.$custID.','.$comment.','.$rating.',GETDATE(),0,0);';
            $query = "INSERT INTO prod_reviews(prod_id, cust_id, comment, rating, date, flagged, banned) VALUES ($prod_ID, $custID, '$comment', $rating, $date, 0, 0);";
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Insert";

            $addResult = $conn->query($query) ;
            if($addResult )
            {
                $Msg = "Record Saved!<br>";
            }else{
                $errQuery1 = "ERROR: Record could not be Saved!<br>"; 
            }
           

            /*Update Orders2 Table */
            $sUPDATE = "UPDATE orders2 SET reviewed = 1 WHERE prod_id = $prod_ID AND cust_id = $custID";
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Insert";

            $addResult = $conn->query($sUPDATE) ;
            if($addResult )
            {
                $Msg ="Record Saved!";
                $Msg;
            }else{
            $errQuery2 = "ERROR: Record could not be Saved!<br>";

             }
             
             if(empty($errQuery2) && empty($errQuery1)){
                 echo "Success";
             }else {
                 echo $errQuery1." ".$errQuery2;
             }


        }else {
                echo $errComment." ".$errRating;
            }
            }//$_POST

?>