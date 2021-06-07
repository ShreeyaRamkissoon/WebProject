<!DOCTYPE html>
<?php if (!isset($_SESSION)) {
        session_start();
    }?>
<html>
    <head>
        <title>View Product List</title>

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    

        <script src="https://kit.fontawesome.com/ac005c1be0.js" crossorigin="anonymous"></script>



        <script>
            $(document).ready(function(){
                    $(document).on('change','#select',function(){
                        var answer = $(this).val();
                        //alert(answer);
                        var img_path = "images/";
                        
                        $.ajax({
                            url:"includes/getImage.php", 
                            data: { imgName: answer},
        
                            method: "POST", 
                            success:function(data){
                               img_path = img_path+data;
                               //console.log(img_path);
                               $('#content img').attr("src",img_path);
                               
                            },
                            error: function(xhr){
                                alert("An error occured: " + xhr.status + " " + xhr.statusText);
                            }

                        });//ajax
                    });

                    $(document).on('click',"#subBtn",function(){
                        var prodID = $('#select option:selected').attr('id');
                        var Rating = $('input[name="inlineRadioOptions"]:checked').val();
                        var comment = $('#textArea textarea').val();
                        var custID = $('.custID').attr('id');
                        
                        $.ajax({
                            url:"includes/addReviews.php", 
                            data: { product_id: prodID,
                                    rating : Rating,
                                    comment : comment,
                                    cust_id: custID },
        
                            method: "POST", 
                            success:function(result){
                               console.log(result);
                               $("#errorModal p#errorText").html(result);
                               $("#errorModal").modal();
                            
                                window.location.reload();
                                
                
                    
                               
                            },
                            error: function(xhr){
                                alert("An error occured: " + xhr.status + " " + xhr.statusText);
                            }
                        });
                        
                        
                    });


            });
        </script>
        

        <style>
            #container{
                position: absolute;
                top: 150px;
                right: 500px;
                width: 100vh;
                height: 500px;
                font-size: 15px;
                background-color: white;
                padding: 10px;
                color: black;
                border-radius: 5px;
                overflow: auto;
            }

            #content{
                position: absolute;
                top: 150px;
                right: 125px;
                width: 40vh;
                height: 300px;
                font-size: 15px;
                background-color: white;
                padding: 10px;
                color: black;
                border-radius: 5px;
                overflow: hidden;
            }

            #content img{
                width:40vh; 
                
                
            }
        </style>
    </head>
    <body>
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <!-- END OF BOOTSTRAP -->

        <?php include 'header.php' ?>

        <!-- Modal -->
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle" style="color:rebeccapurple">Attention</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <p id="errorText"></p>
              </div>

              </div>
          </div>
        </div>
    <!-- End of Modal --> 

        <div id="container">
            <h1 style="text-align:center;margin-bottom:20px" >Write Reviews about Procucts </h1>
            <!-- //////////////////////////////////////////////////////////////////////////////-->
            <form>
               
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Bought Instrument</label>
                    <select class="form-control" id="select">
                    <option>Select Your Instrument</option>
                  
            <!-- //////////////////////////////////////////////////////////////////////////////-->
            <?php 
                require_once "includes/db_connect.php";

                //Displaying data from database to the different input fields
                $username = $_SESSION['fname'];
                
                //query to search for data of the customer
                $nQuery = "SELECT * FROM customer WHERE username = '$username'";
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $nresult = $conn->query($nQuery);
                $userData = $nresult->fetch(PDO::FETCH_ASSOC);
                
                $custID = $userData['cust_id'];

                $query = "SELECT product.pname, product.prod_id
                            FROM orders2 o 
                            LEFT JOIN customer ON customer.cust_id = o.cust_id 
                            LEFT JOIN product ON product.prod_id = o.prod_id
                            WHERE o.cust_id = $custID AND reviewed = 0 ; ";
                            
                 $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                 $nresult = $conn->query($query);
                 

                 while ($newData = $nresult->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <option id="<?php echo $newData['prod_id'];?>">
                        <?php echo $newData['pname'];?>
                    </option>
                 




                  <?php 
                 }
     
            ?>
                    </select>
                </div>
                
                <div class="form-group" id="textArea">
                    <label for="exampleFormControlTextarea1">Example textarea</label>
                    <textarea class="form-control" maxlength="255" placeholder="Enter Comment Here"  rows="3"></textarea>
                </div>

                <div class="form-group" id="radio" >
                    <label for="exampleFormControlTextarea1">Rating</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1">1(Very Bad)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                        <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="3">
                        <label class="form-check-label" for="inlineRadio3">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="4">
                        <label class="form-check-label" for="inlineRadio3">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="5">
                        <label class="form-check-label" for="inlineRadio3">5 (Very Good)</label>
                    </div>
                </div>
                <div class="col text-center" style="margin-top:30px">
                    <input id="subBtn" value="Submit Review" type="button" class="btn btn-primary">
                    <input type="hidden" id="<?php echo $custID ?>" class="custID">
                </div>
            </form>
        </div>
        <div id="content" class="card">
            <img src="images/mylogo.png" alt="Product" class="card-img" id="img">
        </div>

        
    </body>
</html>