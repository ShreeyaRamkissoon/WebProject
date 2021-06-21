<?php 
    if (!isset($_SESSION)) {
        session_start();
    }
    include_once'includes/db_connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Service</title>
</head>
<body>
    <?php include 'header.php'; ?>

            

    <figure>
        <img src="images/service.jpeg" alt="Service" style="width:100%;height:70%">
        <figcaption style="background-color: DimGray; color: white;font-style: bold;padding: 20px;text-align: center;"><h1>Our Service</h1></figcaption>
    </figure>
    <br><br>
    <div class="container">
    <h1>Customer Service</h1>
    <p>Our aim is to make sure you experience the best quality of music and as well as spend a good time while shopping from our shop. We want to make 
        sure that we're providing you with the best quality service and hence, it would be wonderful if you could just drop a review 
    for us to know how we're doing and improve where necessary. Thank you!</p>
    </div>

    <br>

    <?php
        if (isset ($_SESSION['fname'])){
            echo '<form action="write_reviews.php">
            <div class = "row justify-content-center">
            <div class="jumbotron " style="background-color:transparent;border-style:none;">
                <input value="Write Review" type="submit" class="btn btn-success">
            </div>
            </div>
            </form>
            
            ';
        }else{
            echo '<form action="login_form.php" method="post">
            <div class = "row  text-center justify-content-center">
            <div class="jumbotron " style="background-color:transparent;border-style:none;" >
            <h6> You Must Log-In First to write a Review </h6>
            <input value="Log-In" type="submit" class="btn btn-success btn-lg">
            </div>
            </div>
            </form>' ;  

        }
        

    ?>


    <div class="container" style="text-align: center;">
    <h2>Reviews</h2>
    <div class="row py-100 justify-content-center align-items-center">

            
    <?php 
        $squery = "SELECT r.rev_id, r.review, r.rating, r.rev_date, c.fname FROM reviews r inner join customer c on r.cust_id= c.cust_id";
                    //an inner join between Customer and reviews to get customer name
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $result = $conn->query($squery);

        while($userResult = $result->fetch(PDO::FETCH_ASSOC)){
            //loop to obtain the 
    ?>


    <div class="col-sm-3 my-3 my-md-0">
            <form action="service.php" method="post">
            <div class="card shadow" style="width: 18rem;">    
                    <div class="card-body">
                    <h5 class="card-title"><?php echo $userResult['fname']?></h5>
                    <div class="container" style="padding-bottom:20px;padding-left:0px;">
                    <p><?php echo 'Rating= '.$userResult['rating'].'/5'; ?></p>
                    <p class="card-text"><?php echo $userResult['review']?></p></div>

                    <h4><?php echo $userResult['rev_date']; ?></h4>
                    
                    </div>
            </div>
                
            </form>
        </div>
        <?php 
        }
    ?>
    </div>
    </div>

    

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>