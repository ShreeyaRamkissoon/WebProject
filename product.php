<?php include 'header.php';
    if (!isset($_SESSION)) {
        session_start();
    }
    include_once'includes/db_connect.php';

    
        //after add to cart button has been pressed
        if((isset($_POST['add'])) && isset($_SESSION['fname']) ){
            //print_r($_POST['product_id']);
            //add product id to the session variable
            if(isset($_SESSION['cart'])){ 
                //Session Variable is already set
                //Check if a product is already in the Session Variable
                $item_array_id = array_column($_SESSION['cart'],"product_id"); //return an arry of prpoduct id

                if (in_array($_POST['product_id'],$item_array_id)){ 
                    //if product id is in the array
                    //display message
                    echo "<script>alert('Product is already in the cart')</script>";
                    echo "<script>window.location='product.php'</script>";
                }else{
                    //if product is not in the array
                    $count = count($_SESSION['cart']); //count the number of elements in the variable
                    $item_array = array(
                        'product_id'=>$_POST['product_id'] //
                    ); //create array to store product id
                    $_SESSION['cart'][$count] = $item_array;
                    echo "<script>window.location='product.php'</script>";
                

                }

            }else { //if there are no products in cart
            $item_array = array(
                'product_id'=>$_POST['product_id'] //
            ); //create array to store product id

            //create new Session Variable
            $_SESSION['cart'][0]=$item_array; //insert array item in cart session variable at index 0
            echo "<script>window.location='product.php'</script>";

            }
        }else {
            if ((isset($_POST['add'])) && (!isset($_SESSION['fname']))) {
                    echo "<script>alert('You Must Log-in First')</script>";
                    echo "<script>window.location='login_form.php'</script>";
            }
        }


?>
<html>
    <style>
        .card{
            margin: 25px;
            max-width: 100%;
            height: auto ;
            
        }
        .card img{
            max-width: 100%;
            max-height: auto;
        }
    </style>

    <head>
        <title>Products</title>
    </head>

    <body>

    <div class="container">
        <div class="row text-center py-5">
        <?php
            $sQuery = "SELECT * FROM product";
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $result = $conn->query($sQuery);
                        

            while($userResult = $result->fetch(PDO::FETCH_ASSOC)){  
                if(($_SESSION['category_id']) == ($userResult['category_id'])){
        ?>
        <div class="col-sm-3 my-3 my-md-0">
                <form action="product.php" method="post">
                <div class="card shadow" style="width: 18rem;">
                    <img src="images/<?php echo $userResult['image'] ?>" class="card-img-top">    
                    <div class="card-body">
                    <h5 class="card-title"><?php echo $userResult['pname']?></h5>
                    <div class="container" style="padding-bottom:20px;padding-left:0px;"> <p class="card-text"><?php echo $userResult['description']?></p></div>
                    <h4><?php echo '$ '.$userResult['price']; ?></h4>
                    <button type="submit" class="btn btn-warning my-3"name="add">Add To Cart <i class="fas fa-shopping-cart"></i></button>
                    <input type="hidden" name="product_id" value="<?php echo $userResult['prod_id']; ?>"> <!-- to return the product id of the product when clicked -->
                    </div>
                </div>
                    
                </form>
            </div>

            <?php
                     }
                } 
            ?>
    
        </div>
    
    
    </div>
       
    <?php include 'footer.php' ;?>    </body>


</html>