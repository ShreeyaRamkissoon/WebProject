<!DOCTYPE html>
<?php include 'includes/db_connect.php' ?>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
              <!-- a carousel slider to produce an image slider with captions using bootstrap 4 -->
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100" src="images/musicBanner1.jpg" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h1>Welcome To TheMusicShop</h1>
                            <p>Online Music platform based in Mauritius.</p>
                        </div>
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="images/musicBanner2.jpg" alt="Second slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h1>How is it that music can, without words, evoke our laughter, our fears, our highest aspirations?</h1>
                            <p>-Jane Swan</p>
                        </div>
                        </div>
                    </div>
                    <!-- slides back and forth between the images-->
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    
                </div>

                <!-- container to display the products-->
            <div class="product-box">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-all text-center">

                                <h1><br>Featured Products</h1>
                                <p>Our aim is to provide you with the finest gears for a quality music experience.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row text-center py-5">
        <?php
            $sQuery = "SELECT * FROM product ORDER BY RAND() limit 8"; //the products are selected at random using the RAND() function
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $result = $conn->query($sQuery);
                        

            while($userResult = $result->fetch(PDO::FETCH_ASSOC)){ // a while loop to display the products 
                
        ?>
        <div class="col-sm-3 my-3 my-md-0">
                <form action="category.php" method="post">
                <div class="card shadow" style="width: 18rem;">
                    <img src="images/<?php echo $userResult['image'] ?>" class="card-img-top">    
                        <div class="card-body">
                        <h5 class="card-title"><?php echo $userResult['pname']?></h5>
                        <div class="container" style="padding-bottom:20px;padding-left:0px;"> <p class="card-text"><?php echo $userResult['description']?></p></div>
                        <h4><?php echo '$ '.$userResult['price']; ?></h4>
                        <button type="submit" class="btn btn-warning my-3"name="add">Buy Product <i class="fas fa-shopping-cart"></i></button>
                        </div>
                </div>
                    
                </form>
            </div>

            <?php
                     
                } 
            ?>
    
        </div>
    
    

                
                </div>
            </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>