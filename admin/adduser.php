<!doctype html>
<html lang="en">
  <head>
  <title>Welcome</title>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
     
      <link rel="stylesheet" type="text/css"  title="Navbar Css" href="css/style2.css">
      <script src="https://kit.fontawesome.com/ac005c1be0.js" crossorigin="anonymous"></script>

      <script>
        $(document).ready(function(){
          $(document).on('click',"#buttonSub",function(){
            var name = $("input#name").val();
            var lname = $("input#lname").val();
            var email = $("input#email").val();
            var password = $("input#password").val();

            //alert("Name = "+ name +" " + lname +" " + email  +" " +password);
            $.ajax({
              url:"include/addAdmin.php", 
              data: { user: name,
                      pwd:password,
                      lname:lname,
                      email:email},

              cache: false,
              method: "POST", 
              success:function(result){
                console.log(result);
                $("div#errorModal").modal();
                $("div#errorModal p#errorText").html(result);
                  
              },
              error: function(xhr){
                  alert("An error occured: " + xhr.status + " " + xhr.statusText);
              }
            });//$.ajax

          });



        });
      </script>
    <style>
       
        #addUser{
            position: absolute;
            top: 30px;
            right: 300px;
            width: 75vh;
            height: 600px;
            font-size: 15px;
            background-color: rgb(0, 0, 0);
            padding: 10px;
            color: white;
            border-radius: 5px;
            overflow: hidden;
            
        }


    </style>
  </head>
  <body>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
  <nav class="nav flex-column" id="navigation_bar">
  <a class="nav-link" href="main.php" active ><i class="fas fa-columns fa-1.8x"></i>Dashboard</a>
      <a class="nav-link" href="adduser.php">Add User</a>
      <a class="nav-link" href="productlist.php">Product List</a>
      <a class="nav-link" href="orders.php">Orders</a>
      <a class="nav-link" href="addproduct.php">Manage Products</a>
      <a class="nav-link" href="#">Manage User</a>
      <a class="nav-link" href="#">Log Out</a>
   </nav>

   <div id="addUser">
           
            <h2 style="text-align: center;">Add Admin</h2>

            <form method="post">
          

                    <label  for="name">Enter you Name :</label>
                    <input class="form-control input-borders" id="name" >

                    <br>
                    <label for="lname">Last name :</label>
                    <input class="form-control input-borders" id="lname">


                    <br>
                    <label for="email">Email</label>                           
                    <input class="form-control input-borders" type="email" id="email" >

                    <br>
                    <label for="password">Password</label>                        
                    <input class=" form-control input-borders"  name="fpassword" id="password" placeholder="Password" id="password" >
                    <br>
                <div class=" col text-center">
                      <button type="button" class="btn" style="background-color: rgb(179, 82, 179); color:white;" id="buttonSub">Add Admin</button>
                </div>
            </form>
        
        </div>
        <!-- Modal -->
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle" style="color:rebeccapurple">Error</h5>
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
    
  </body>
</html>