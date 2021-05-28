<?php
    if (!isset($_SESSION)) {
        session_start();
    };
    include_once'includes/db_connect.php';
    include 'header.php';
    //print_r($_SESSION['cart']);
    if(isset($_POST['remove'])){
        if($_GET['action'] == 'remove'){
            foreach($_SESSION['cart'] as $key=>$value){
                if($value['product_id'] == $_GET['id']){
                    unset($_SESSION['cart'][$key]);
                    echo "<script>alert('Product Has been removed')</script>";
                    echo "<script>window.location='cart.php'</script>";
                }
            }
        }
    }
   
    function cartElement($prodImg,$prodName,$prodPrice,$prodID){
        $element = '
        
        <form action="cart.php?action=remove&id='.$prodID.'" method="post" class="cart-items">
        <div class="border rounded">
            <div class="row bg-white">
                <div class="col-md-3">
                    <img src="images/'.$prodImg.'" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h5 class="pt-2">'.$prodName.'</h5>
                    <small class="text-secondary">Brand</small>
                    <h5 class="pt-2">'.$prodPrice.'</h5>
                    <button type="submit" class="btn btn-danger mx-2" name="remove">Remove</button>
                </div> 
        
            </div>
        </div>
        </form>
        ';

        echo $element;
    };

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cart</title>

        
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://kit.fontawesome.com/ac005c1be0.js" crossorigin="anonymous"></script>

        <style>
            .cart-items{
                padding-top:5px;
                padding-bottom: 5px;        
                }   
        </style>
    </head>
    <body>
        <div class="containter-fluid">
            <div class="row px-5">
                <div class="col-md-7">
                    <div class="shopping-cart">
                        <h6> My Cart</h6>
                        <hr>
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
                                            cartElement($userResult['image'],$userResult['pname'],$userResult['price'],$userResult['prod_id']); //calling cartElement fucntion to display details about products
                                            $total = $total + (int)$userResult['price'] ; //calculating total price

                                        }
                                    }

                                }
                                if(isset($_SESSION['total'])){
                                    $_SESSION['total'] =  $total;
                                }else{
                                    $_SESSION['total'] =  $total;
                                }
                            }else {
                                echo'<h5>The Cart Is Empty</h5>';
                            }
                            
                        ?>
                    </div>
                
                </div>
                <div class="col-md-5">
                    <div class="pt-4">
                        <h6> Price Details</h6>
                        <hr>
                        <div class="row price-details">
                            <div class="col-md-6">
                                <?php 
                                    if(isset($_SESSION['cart'])){
                                        $count = count($_SESSION['cart']); //counting the number of products in the cart
                                        echo "<h6>Price ($count items)</h6>";
                                    }else{
                                        echo "<h6>Price ( items)</h6>";
                                    }
                                ?>
                                <h6>Delivery Fee</h6>
                                <hr>
                                <h6> Amount Payable </h6>
                            </div>
                            <div class="col-md-6">
                                <?php 
                                    echo $total;
                                ?>
                                <h6 class="text-success"> FREE</h6>
                                <hr>
                                <?php 
                                    echo $total;
                                ?>
                            </div>
                        </div>
                        <?php 
                            
                            if(isset($_SESSION['cart'])){
                                echo'
                                <div class="container>
                                    <div class="row justify-content-center">
                                        <form action="checkout.php" style="padding-top: 60px;">
                                            <input type="submit" value="Continue to checkout" class="btn btn-success" >
                                        </form>
                                    </div> 
                                </div>
                                
                                ';
                            }
                        
                        ?>              
                    </div>
                
                </div>

            </div>
        </div>    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <?php include 'footer.php' ?>
    </body>
</html>