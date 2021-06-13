<?php 
    if (!isset($_SESSION)) {
        session_start();
    }else{
        unset($_SESSION['category_id']);
    }
    include_once'includes/db_connect.php';

    if(isset($_POST['go'])){
        //print_r($_POST['cat_id']);
        //create session variable to store category id
        $_SESSION['category_id'] = $_POST['cat_id'];
        echo "<script>window.location='product.php'</script>";
    }

?>
<html>
    
    <head>
        <title>Category</title>
        <style>
        
        body{
            background-image: url("images/trial1.jpg");
        }
        .card{
            margin: 10px;
            max-width: 7cm;
            height: 10cm ;
            
        }
        .card img{
            max-width: 7cm;
            max-height: 10cm;
        }
    </style>

    </head>

    <body>
        <?php include 'header.php'; 
        ?>
        <!--Title -->
        <h1 style="text-align:center;color:black;">Shop By Category </h1>
        <div class="container">
        <div class="row text-center ">


                <?php 
                    //Selecting everything from database in Category table
                    $squery = "SELECT * FROM category";
                    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $result = $conn->query($squery);

                    while($userResult = $result->fetch(PDO::FETCH_ASSOC)){  
                ?>
                
                <div class="col-sm-3 my-3 my-md-0 mx-2">
                    <form action="category.php" method="post">
                        <div class="card shadow"style="border-rounded:20%;">
                            <img src="images/<?php echo $userResult['image']?>" class="card-img-top" style="width: auto;height:250px;">    
                            <div class="card-body">
                            <button type="submit" class="btn btn-warning my-3"name="go"><?php echo $userResult['cname']?></button>
                            <input type="hidden" name="cat_id" value="<?php echo $userResult['category_id']; ?>"> <!-- to return the product id of the product when clicked -->
                            </div>
                        </div>   
                    </form>
                </div>

                <?php 
                    }
                ?>  
    
        </div>
    
    
    </div>
    
    <?php include 'footer.php' ?>
    </body>


</html>