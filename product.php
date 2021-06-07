<?php include 'header.php';
    if (!isset($_SESSION)) {
        session_start();
    }
    include_once'includes/db_connect.php';

        //We are testing something
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
    <head>

        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
     
        
        <script src="https://kit.fontawesome.com/ac005c1be0.js" crossorigin="anonymous"></script>

        <style>
            .card{
                margin: 25px;
                max-width: 100%;
                height: auto ;
                
            }
            .card img{
                width: 275px;
                max-height: auto;
            }

            .fa-star{
               color: blue;
            }



        </style>
        <script>
            $(document).ready(function(){
                $(document).on('click','div#reviews a',function(e){
                    e.preventDefault();
                    
                    var prodID = $(this).attr('id');
                    //console.log(prodID);
                    $("div#errorModal div#body h6#rev_name").html("");
                    $("div#errorModal div#body p#rating").html("");
                    $("div#errorModal div#body p#comment").html("");

                    $.ajax({
                        url:"includes/getReviews.php", 
                        data: { prod_id:prodID},
                        accepts: "application/json",
                        cache: false,
                        method: "POST", 
                        success:function(data){
                            console.log(data);
                           // $("div#errorModal").modal();
                            //$("div#errorModal p#errorText").html(result);

                            $.each(data , function(key,entry){
                                $("div#errorModal div#body h6#rev_name").html(entry.fname+"<br>");
                                
                                $("div#errorModal div#body p#comment").html("Review : " + entry.comment+"<br>");
                                
                                for(i = 0 ; i < entry.rating ; i++){
                                    
                                    $("div#errorModal div#body p#rating").append('<i class="fas fa-star"></i>');
                                }
                             
                            });
                            //console.log("Calling Modal");
                            $("div#errorModal").modal();

                            
                        },
                        error: function(xhr){
                            alert("An error occured: " + xhr.status + " " + xhr.statusText);
                        }

                    });//Ajax
                });
            });
        </script>

        <title>Products</title>
    </head>

    <body>
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle" style="color:rebeccapurple">Reviews</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body" id="body">
                  <h6 style="text-align:center" id="rev_name"></h6>
                  <p id="rating" ></p>
                  <p id="comment" ></p>
              </div>

              </div>
          </div>
        </div>
    <!-- End of Modal --> 

    <div class="container">
        <div class="row text-center py-5">
        <?php
            $sQuery = "SELECT * FROM product";
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $result = $conn->query($sQuery);
                        

            while($userResult = $result->fetch(PDO::FETCH_ASSOC)){  
                if(($_SESSION['category_id']) == ($userResult['category_id'])){
        ?>
        <div class="col-sm-4 my-3 my-md-0">
                <form action="product.php" method="post">
                <div class="card shadow" style="width: 18rem;">
                    <img id="prod_Detail" src="images/<?php echo $userResult['image'] ?>" class="card-img-top">  
                    <div class="card-body">
                    <div>
                        <h5 class="card-title" style="font-size:15px"><?php echo $userResult['pname']?></h5>
                    </div>
                    <div style="margin-bottom:10px" id="reviews">
                        <a href="#" id="<?php echo $userResult['prod_id']; ?>"><i class="far fa-star"></i> Review <i class="far fa-star"></i> </a>
                    </div>
                   
                    <h4><?php echo '$ '.$userResult['price']; ?></h4>
                    <button type="submit" class="btn btn-warning my-3"name="add">Add To Cart <i class="fas fa-shopping-cart"></i></button>
        
                    <input type="hidden" id="prod_ID" name="product_id" value="<?php echo $userResult['prod_id']; ?>"> <!-- to return the product id of the product when clicked -->
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
  
       
    <?php include 'footer.php' ;?>    

</body>


</html>