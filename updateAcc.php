<?php 
    if (!isset($_SESSION)) {
        session_start();
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


    <title>Update Account</title>
    <style>
        
        #update{
            position: inherit;
            
            margin-left: 25vw;
            width: 45vw;
            height: auto;
            border-radius: 35px;
        }
    </style>

    <script>
            $(document).ready(function(){
                var obj_json ;
                var url = "includes/getUserDetails.php";
                $.getJSON( url, function(data) {
                
                        obj_json = data;
                        //Let us populate the drop down list
                        //Reference https://www.codebyamir.com/blog/populate-a-select-dropdown-list-with-json
                        $.each(data, function (key, entry) {
                            $('input#fname').val(entry['fname']);
                            $('input#lname').val(entry['lname']);
                            $('select#gender').val(entry['gender']);
                            $('input#dob').val(entry['dob']);
                            $('input#email').val(entry['email']);
                            $('input#phone').val(entry['phone']);
                            $('input#city').val(entry['city']);
                            $('input#street').val(entry['street']);
                            $('input#usernameOld').val(entry['username']);
                            $('input#passwordOld').val(entry['password']);
                        });
                        
                });

                $(document).on('click','button#buttonUpdate',function(){
                    console.log('Button Clicked');

                        var fname =  $('input#fname').val();
                        var lname = $('input#lname').val();
                        var gender =   $('select#gender').val();
                        var dob =   $('input#dob').val();
                        var email =   $('input#email').val();
                        var phone =    $('input#phone').val();
                        var city =    $('input#city').val();
                        var street =    $('input#street').val();
                        var usernameOld =    $('input#usernameOld').val();
                        var passwordOld =   $('input#passwordOld').val();
                        var newUsername =    $('input#newUsername').val();
                        var newPassword =   $('input#newPassword').val();
                        var userID = $('input#userID').val();

                        var url = "http://localhost/WebProject_WebServices/user/update/" + userID ;
		
                        $.ajax({
                            url: url,
                            //accepts: "application/json",
                            headers:{Accept:"application/json" },
                            
                            method: "POST", 
                            data:{  fname:fname,
                                lname:lname,
                                gender:gender,
                                phone:phone,
                                city:city,
                                street:street,
                                newUsername:newUsername,
                                newPassword:newPassword,
                                date:dob,
                                email:email,
                            },
                            error: function(xhr){
                                
                                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                            }
                        })
                        .done(function(data)
                        {	
                            //$("span#createresult").html();
                            $("#staticBackdrop p#errorText").html("Account Updated Sucessfully");
                            $("#staticBackdrop").modal();
                        })//.done(function(data)
                        ;//$.ajax({
                    
                        
                        
                });

                $(document).on('click' , 'button#modalClose' ,function(){
                    window.location.reload();
                });
            });
    </script>
</head>
<body>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- END OF BOOTSTRAP -->

    <?php 
        include 'header.php';
    ?>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                <div class="modal-footer">
                    <button type="button" id="modalClose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
          </div>
        </div>
    <!-- End of Modal --> 

    <h1 style="text-align:center;">Update Your Account</h1>
    <div id="update">
        <form method="post">
            
            <div class="row">
                <div class="col">
                    <label  for="name">First Name :</label>
                    <input class="form-control input-borders"  id="fname" >
                </div>

                <div class="col">
                    <label  for="name">Last Name :</label>
                    <input class="form-control input-borders"  id="lname" >
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-5">
                    <label for="exampleFormControlSelect1">Gender:</label>
                    <select class="form-control" id="gender">
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>                    
                    </select><br>
                </div>
                <div class="col">
                    <label  for="name">Date of Birth :</label>
                    <input class="form-control input-borders" type="date" id="dob" >
                </div>
               
            </div>

            <div class="row">
                <div class="col-8">
                        <label  for="name">Email :</label>
                        <input class="form-control input-borders" type="email" id="email" >
                </div>
                <div class="col">
                    <label  for="name">Phone :</label>
                    <input class="form-control input-borders" type="email" id="phone" >
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label  for="name">City :</label>
                    <input class="form-control input-borders" type="email" id="city" >
                </div>
                <div class="col">
                    <label  for="name">Street :</label>
                    <input class="form-control input-borders" type="email" id="street" >
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label  for="name">Username :</label>
                    <input class="form-control input-borders" disabled type="email" id="usernameOld" >
                </div>
                <div class="col">
                    <label  for="name">Password :</label>
                    <input class="form-control input-borders" disabled type="email" id="passwordOld" >
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label  for="name">New Username :</label>
                    <input class="form-control input-borders" id="newUsername" >
                </div>
                <div class="col">
                    <label  for="name">New Password :</label>
                    <input class="form-control input-borders" type="password" id="newPassword" >
                </div>
            </div>
            <input type="hidden" id="userID" value="<?php echo $_SESSION['user_id']?>" >

            

            <!--<label for="exampleFormControlFile1">Product Image</label>
            <input type="file" class="form-control-file" id="fileChooser"><br> -->
            <br>
            <div class=" col text-center">
                <button type="button" class="btn" style="background-color: rgb(179, 82, 179); color:white;" id="buttonUpdate">Update Product</button>
            </div>

            <br><bR></bR>
        </form>
    
    </div>





    <?php 
        include 'footer.php';
    ?>
</body>
</html>