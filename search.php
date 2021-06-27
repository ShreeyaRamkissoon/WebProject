<?php 
    /*$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "musicshop";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }*/
    include_once'includes/db_connect.php';
    if (!isset($_SESSION)) {
        session_start();
    }
    
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
                    echo "<script>window.location='search.php'</script>";
                }else{
                    //if product is not in the array
                    $count = count($_SESSION['cart']); //count the number of elements in the variable
                    $item_array = array(
                        'product_id'=>$_POST['product_id'] //
                    ); //create array to store product id
                    $_SESSION['cart'][$count] = $item_array;
                    echo "<script>window.location='search.php'</script>";
                

                }

            }else { //if there are no products in cart
            $item_array = array(
                'product_id'=>$_POST['product_id'] //
            ); //create array to store product id

            //create new Session Variable
            $_SESSION['cart'][0]=$item_array; //insert array item in cart session variable at index 0
            echo "<script>window.location='search.php'</script>";

            }
        }else {
            if ((isset($_POST['add'])) && (!isset($_SESSION['fname']))) {
                    echo "<script>alert('You Must Log-in First')</script>";
                    echo "<script>window.location='login_form.php'</script>";
            }
        }


  
?>

<!DOCTYPE html>
<html lang="en">
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
               color: rebeccapurple;
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
                        
                            if(data.length == 0){
                                var table_str = '<h5 style="text-align:center">This Product has not been Reviewed yet<h5>';
                            }else{
                                var table_str = '<table class="table table-hover table-sm table-borderless"><thead><tr><th scope="col">Reviewer Name</th><th scope="col">Comment</th><th scope="col">Rating</th></tr></thead><tbody>';
                            
                                $.each(data , function(key,entry){
                                    var stars = "";
                                    table_str = table_str + "<tr>"
                                    table_str = table_str + '<td>' + entry['fname'] + '</td>';
                                    table_str = table_str + '<td>' + entry['comment'] + '</td>';
                                    table_str = table_str + '<td>' ;
                                        for (let i = 0; i < entry['rating']; i++) {
                                            stars = stars + '<i class="fas fa-star"></i>';
                                        }
                                        table_str = table_str + stars;
                                    table_str =table_str + '</td>';
                                    table_str = table_str + "</tr>"; 
                                });

                                table_str = table_str + "</tbody></table>";
                            }

                            $("div#errorModal div#body").html(table_str);
                            $("div#errorModal").modal();

                            
                        },
                        error: function(xhr){
                            alert("An error occured: " + xhr.status + " " + xhr.statusText);
                        }

                    });//Ajax
                });
            });
        </script>
</head>
<body>
<?php include 'header.php' ?>

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
                  
              </div>

              </div>
          </div>
        </div>
    <!-- End of Modal --> 
    


<div class="container">
        <div class="row text-center py-5">
<?php
   /* if(isset($POST['submit-search'])){
$search = mysqli_real_escape_string($conn,$_POST['seacrh']);

$sql = "SELECT * FROM 'product' WHERE 'pname' LIKE '%$search%' OR 'description' LIKE '%$search%' " ;
$result = mysqli_query($conn, $sql);
$queryResult = mysqli_num_rows($result);
print_r($queryResult);
   
if ($queryResult > 0){
    while ($row = mysqli_fetch_assoc($result)){
            echo "<div class = 'container'>
                <h3>".$row['pname']."</h3>
                <p>".$row['description']."</p>
                <h5>".$row['price']."</h5>
                </div>";

    }} 
else{
    echo "There are no results matching your search!";
}
*/          $search = "";
            if(isset($_SESSION['searched_prod'])){
                if(isset($_POST['search'])){
                    array_push($_SESSION['searched_prod'],$_POST['search']);
                    $search = $_POST['search'];
                }else{
                    $count = count($_SESSION['searched_prod']);
                    $search = $_SESSION['searched_prod'][$count -1];
                }
            }else{
                $_SESSION['searched_prod'] = array();
                if(isset($_POST['search'])){
                    array_push($_SESSION['searched_prod'],$_POST['search']);
                    $search = $_POST['search'];
                }else{
                    echo "<script>window.location='index.php'</script>";
                }
            }
            


            $sQuery = "SELECT * FROM product WHERE pname LIKE '%$search%' OR description LIKE '%$search%' " ;
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $result = $conn->query($sQuery);
                        

            while($userResult = $result->fetch(PDO::FETCH_ASSOC)){  
            
            ?>
            <div class="col-sm-4 my-3 my-md-0">
                <form action="search.php" method="post">
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

            ?>
</div> 
</div>
</body>
</html>