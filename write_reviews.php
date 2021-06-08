<!DOCTYPE html>
<?php 
    include 'includes/db_connect.php';
    if (!isset($_SESSION)) {
        session_start();
    }

    $rating ="0";
    $review ="0";
    $ERRrating = $ERRreview = "";
    $curDate = date("Y/m/d");
    $username = $_SESSION['fname'];

    //Getting Customer informationlkjnjjhb
    $nQuery = "SELECT * FROM customer WHERE username = '$username'";
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $nresult = $conn->query($nQuery);
    $userData = $nresult->fetch(PDO::FETCH_ASSOC);
    $custID = $userData['cust_id'];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $rating = $_POST['rating'];
        $review = $_POST['review'];
        
        echo $rating;
        echo $review;
        if(empty($rating)){
            $ERRrating = "Please select a rating Value";
        }

        
        if(empty($review)){
            $ERRrating = "Please Enter the Review ";
        }

        if(empty($ERRrating) && empty($ERRreview)){
            //inserting review into database
            $sql = $conn->prepare("INSERT INTO reviews(review,rev_date,cust_id,rating) VALUES (:rev,:dt,:cust,:rat)");
            $sql->bindParam(':rev',$review);
            $sql->bindParam(':dt',$curDate);
            $sql->bindParam(':cust',$custID);
            $sql->bindParam(':rat',$rating);

            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $addResult = $sql->execute(); // Return the number for rows afected
             if ($addResult) {
                    //if 1 or more rows have been affected
                     $Msg = "Recorde Saved !";
                     echo "$Msg";
                     $Msg;
             }else {
                    $Msg = "Error Records could not be Saved";
                     echo "$Msg";
                     $Msg;
            }
             $conn==null;
        }
    }



?>
<html lang="en">
    <head>
        <title>Write Reviews</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <style>

            .xcontainer{
            margin-top: 5px;
            margin-left: 30%;
            margin-right: 30%;
            font-family: 'Poppins', sans-serif;     
            }

            .error{
            color: rgb(255, 63, 71);
            font-size: 15px;
        
            }
        </style>
    </head>
    <body>
      <?php include 'header.php'?>
      <div class="container">
      <h1 class="text-center"> Feel Free To Write Reviews About the Shop</h1>
      </div>
      <div class="jumbotron xcontainer">
                <?php 
                    if((empty($ERRrating) && empty($ERRreview)) && ($_SERVER["REQUEST_METHOD"] == "POST")){
                ?>
                    <h5 class="text-success text-center"> Thank You Very Much </h5>
                    <form action="category.php" class="text-center">
                        <input type="submit" value="Continue to Shopping" class="btn btn-success" >
                    </form>
                <?php }else { ?>
            
          <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
                
                <fieldset class="row">
                    <legend class="col-form-label">How satisfied with our Website</legend><br>
                    <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rating" value="1" id="gridRadios1" <?php if($rating == 1){echo 'checked' ;}?>>
                        <label class="form-check-label" for="gridRadios1">
                        Totally satisfied(1)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rating" id="gridRadios2" value="2"  <?php if($rating == 2){echo 'checked' ;}?>>
                        <label class="form-check-label" for="gridRadios2">
                        2
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rating" id="gridRadios2"  value="3" <?php if($rating == 3){echo 'checked' ;}?>>
                        <label class="form-check-label" for="gridRadios2">
                        3
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rating" id="gridRadios2"  value="4" <?php if($rating == 4){echo 'checked' ;}?>>
                        <label class="form-check-label" for="gridRadios2">
                        4
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="rating" id="gridRadios3"  value="5" <?php if($rating == 5){echo 'checked' ;}?>>
                        <label class="form-check-label" for="gridRadios3">
                        Totally Dissatisfied(5)
                        </label>
                    </div>
                    <span class="error"> <?php echo $ERRrating ?> </span>
                    </div>
                </fieldset><br><br>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Review : </label><span class="error"> <?php echo $ERRreview ?> </span>
                     <textarea class="form-control" name="review" id="exampleFormControlTextarea1" rows="3"><?php echo $review ?></textarea>
                </div>
            
                <input type="submit" class="btn btn-primary" value="submit">
            </form>
            <?php } ?>
            </div>
      </div>
      <?php include 'footer.php' ?>
    </body>
</html>