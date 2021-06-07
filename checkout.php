<?php 
    if (!isset($_SESSION)) {
        session_start();
    }
    include_once'includes/db_connect.php';
    include 'header.php';
    
    
?>
<html>
    
    <head>
        <title>Checkout</title>
        <style>
        
                .row {
                display: -ms-flexbox; /* IE10 */
                display: flex;
                -ms-flex-wrap: wrap; /* IE10 */
                flex-wrap: wrap;
                margin: 0 -16px;
                }

                .col-25 {
                -ms-flex: 25%; /* IE10 */
                flex: 25%;
                }

                .col-50 {
                -ms-flex: 50%; /* IE10 */
                flex: 50%;
                }

                .col-75 {
                -ms-flex: 75%; /* IE10 */
                flex: 75%;
                }

                .col-25,
                .col-50,
                .col-75 {
                padding: 0 16px;
                }

              

                input[type=text] {
                width: 100%;
                margin-bottom: 20px;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 3px;
                }

                label {
                margin-bottom: 10px;
                display: block;
                }

                .icon-container {
                margin-bottom: 20px;
                padding: 7px 0;
                font-size: 24px;
                }

                span.error{
                color: rgb(255, 63, 71);
                font-size: 15px;
                }

                span.price {
                float: right;
                color: grey;
                }

                /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
                @media (max-width: 800px) {
                .row {
                    flex-direction: column-reverse;
                }
                .col-25 {
                    margin-bottom: 20px;
                }
                }
        
        
        
        </style>
    </head>

    <body>
        <?php
            //Displaying data from database to the different input fields
            $username = $_SESSION['fname'];
            
            //query to search for data of the customer
            $nQuery = "SELECT * FROM customer WHERE username = '$username'";
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $nresult = $conn->query($nQuery);
            $userData = $nresult->fetch(PDO::FETCH_ASSOC);

            
            //print_r($userData);
            
            //Declaring variables for validation
            $state = $zip = $cardname = $cardNum = $expMon = $expYear = $cvv = "";
            $ERRstate = $ERRzip = $ERRcardname = $ERRcardNum = $ERRexpMon = $ERRexpYear = $ERRcvv = "";
                        
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                
                //Assigning input values to the Variables
                $state = $_POST['state'];
                $zip = $_POST['zip'];
                $cardname = $_POST['cardname'];
                $cardNum = $_POST['cardnumber'];
                $expMon = $_POST['expmonth'];
                $expYear = $_POST['expyear'];
                $cvv = $_POST['cvv'];

                if(empty($state)){
                    $ERRstate  = 'ERROR!! MISSING DATA ';
                }

                if(empty($zip)){
                    $ERRzip  = 'ERROR!! MISSING DATA ';
                }

                if(empty($cardname)){
                    $ERRcardname  = 'ERROR!! MISSING DATA ';
                }

                if(empty($cardNum)){
                    $ERRcardNum  = 'ERROR!! MISSING DATA';
                }

                if(empty($expMon)){
                    $ERRexpMon  = 'ERROR!! MISSING DATA';
                }

                if(empty($expYear)){
                    $ERRexpYear  = 'ERROR!! MISSING DATA';
                }

                if(empty($cvv)){
                    $ERRcvv  = 'ERROR!! MISSING DATA';
                }
                
                if(empty($ERRstate) && empty($ERRzip) && empty($ERRcardname) && empty($ERRcardNum) && empty($ERRexpMon) && empty($ERRexpYear) && empty($ERRcvv)){

                
                        // -- UPDATING DATABASE -- //
                        $total = $_SESSION['total'];

                        $curDate = date("Y/m/d"); //Getting Current Date
                        $delDate = strtotime($curDate."+ 2 days");
                        $delDay = date("l", $delDate);
                    
                        //Searching for the particular driver for the Delivery based on the Day
                        $aQuery = "SELECT * FROM driver WHERE workday='$delDay'";
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        $aresult = $conn->query($aQuery);
                        $driverData = $aresult->fetch(PDO::FETCH_ASSOC);
                        $driverID = $driverData['driver_id'];

                        $custID = $userData['cust_id'];

                        //adding data in the orders table
                        /*
                        $sql = $conn->prepare("INSERT INTO orders(order_price,order_date,cust_id,driver_id) VALUES (:price,:orDate,:cust,:driv)");
                        $sql->bindParam(':price',$total);
                        $sql->bindParam(':orDate',$curDate);
                        $sql->bindParam(':cust',$custID);
                        $sql->bindParam(':driv',$driverID);
                    
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                        $sql->execute();  */

                        $prodId = array_column($_SESSION['cart'],'product_id');
                        foreach($prodId as $id){
                            $sql = $conn->prepare("INSERT INTO orders2(prod_id,cust_id,date_purchase,driver_id) VALUES (:pID,:cust,:orDate,:driv)");
                            $sql->bindParam(':pID',$id);
                            $sql->bindParam(':orDate',$curDate);
                            $sql->bindParam(':cust',$custID);
                            $sql->bindParam(':driv',$driverID);
                            //print_r($id);
                            $sql->execute();  
                        }
                        
                        
                
                        // -- END OF UPDATING DATABASE   

                        //unsetting cart variable
                        unset($_SESSION['cart']);
                }
            }

            
        ?>
        <?php if (empty($ERRstate) && empty($ERRzip) && empty($ERRcardname) && empty($ERRcardNum) && empty($ERRexpMon) && empty($ERRexpYear) && empty($ERRcvv) && ($_SERVER["REQUEST_METHOD"] == "POST") ){
           
        ?>

            <div class="container">
                <div class="row text-center justify-content-center">
                    <div class="col-7">
                    <div class="jumbotron">
                        <h1> Thank You For Your Orders </h1><br>
                        <div><i class="fa fa-check-circle fa-4x"></i></div><br>
                        <p> You will Receive your Orders with 2 Days</p><br>
                        <p>Which Should be delivered by our Driver : <?php echo $driverData['dname'] ?></p>
                        <p>Driver Contact: <?php echo $driverData['contact'] ?></p>
                        <form action="category.php">
                            <input type="submit" value="Shop Again" class="btn btn-success" >
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        <?php }else {

?>
        <div class="container py-5" style="background-color:transparent;border-style:none;">
                    <div class="row">
                        <div class="col-75">
                            <div class="container">
                            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">

                                <div class="row">
                                <div class="col-50">
                                    <h3>Billing Address</h3>
                                    <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                                    <input type="text" id="fname" name="firstname" value="<?php echo $userData['fname'].' '.$userData['lname'];?>">
                                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                    <input type="text" id="email" name="email" value="<?php echo $userData['email'];?>">
                                    <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                    <input type="text" id="adr" name="address" value = "<?php echo $userData['street'];?>">
                                    <label for="city"><i class="fa fa-institution"></i> City</label>
                                    <input type="text" id="city" name="city" value="<?php echo $userData['city'];?>">

                                    <div class="row">
                                    <div class="col-50">
                                        <label for="state">State</label><span class="error"> <?php echo $ERRstate ?> </span>
                                        <input type="text" id="state" name="state" placeholder="NY"  value="<?php echo $state; ?>" >
                                        
                                    </div>
                                    <div class="col-50">
                                        <label for="zip">Zip</label><span class="error"> <?php echo $ERRzip ?> </span>
                                        <input type="text" id="zip" name="zip" placeholder="10001"  value="<?php echo $zip; ?>">
                                        
                                    </div>
                                    </div>
                                </div>

                                <div class="col-50">
                                    <h3>Payment</h3>
                                    <label for="fname">Accepted Cards</label>
                                    <div class="icon-container">
                                    <i class="fa fa-cc-visa" style="color:navy;"></i>
                                    <i class="fa fa-cc-amex" style="color:blue;"></i>
                                    <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                    <i class="fa fa-cc-discover" style="color:orange;"></i>
                                    </div>
                                    <label for="cname">Name on Card</label><span class="error"> <?php echo $ERRcardname ?> </span>
                                    <input type="text" id="cname" name="cardname" placeholder="John More Doe"  value="<?php echo $cardname; ?>">
                                    
                                    <label for="ccnum">Credit card number</label><span class="error"> <?php echo $ERRcardNum ?> </span>
                                    <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444"  value="<?php echo $cardNum; ?>">
                                    
                                    <label for="expmonth">Exp Month</label><span class="error"> <?php echo $ERRexpMon ?> </span>
                                    <input type="text" id="expmonth" name="expmonth" placeholder="September" value="<?php echo $expMon; ?>" >
                                    

                                    <div class="row">
                                    <div class="col-50">
                                        <label for="expyear">Exp Year</label><span class="error"> <?php echo $ERRexpYear ?> </span>
                                        <input type="text" id="expyear" name="expyear" placeholder="2018"  value="<?php echo $expYear; ?>">
                                        
                                    </div>
                                    <div class="col-50">
                                        <label for="cvv">CVV</label><span class="error"> <?php echo $ERRcvv ?> </span>
                                        <input type="text" id="cvv" name="cvv" placeholder="352"  value="<?php echo $cvv; ?>">
                                        
                                    </div>
                                    </div>
                                </div>

                                </div>
                        
                                <input type="submit" value="Continue to checkout" class="btn btn-success">
                            </form>
                            </div>
                        </div>

                        <div class="col-25">
                            <div class="container">
                            <h4>Cart
                                <span class="price" style="color:black">
                                <i class="fa fa-shopping-cart"></i>
                                <b>4</b>
                                </span>
                            </h4>
                            <?php 
                                $total = 0;
                                if(isset($_SESSION['cart'])){

                                    //Query for select all data from database using prepared statements
                                    $prodId = array_column($_SESSION['cart'],'product_id');
                                    $sQuery = "SELECT * FROM product";
                                    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                                    $result = $conn->query($sQuery);
                                                
                            
                                    while($userResult = $result->fetch(PDO::FETCH_ASSOC)){
                                        foreach($prodId as $id){
                                            if ($userResult['prod_id'] == $id) {
                    
                                                $total = $total + (int)$userResult['price'] ; //calculating total price
                                                echo '<p>'.$userResult['pname'].'<span class="price">'.$userResult['price'].'</span></p>';
                                            }
                                        }

                                    }
                                }
                               
                            ?>
                    
                            <hr>
                            <p>Total <span class="price" style="color:black"><b>$ <?php echo $total?></b></span></p>
                            </div>
                        </div>
                        </div>
        
        </div>
       
    <?php } ?>
        <?php include 'footer.php'; ?>
    </body>


</html>