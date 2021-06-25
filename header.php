<!doctype html>
<?php if (!isset($_SESSION)) {
        session_start();
    }?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ac005c1be0.js" crossorigin="anonymous"></script>
    <style>

.search {
width: 35%;
}

form.example {
  box-sizing: border-box;
}


      /* Style the search field */
form.example input[type=text] {
  padding: 6px;
  font-size: 15px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

/* Style the submit button */
form.example button {
  float: left;
  width: 20%;
  padding: 6px;
  background: grey;
  color: white;
  font-size: 15px;
  border: 1px solid grey;
  border-left: none; /* Prevent double borders */
  cursor: pointer;
}

form.example button:hover {
  background: black;
}

/* Clear floats */
form.example::after {
  content: "";
  clear: both;
  display: table;
}

      .dropbtn {
        
          background-color: none;
          padding: 16px;
          font-size: 16px;
          border: none;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
          position: relative;
          display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f1f1f1;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }

        .search-header {
            margin: 10px;

        }

        /* Change color of dropdown links on hover */
      .dropdown-content a:hover {background-color: #ddd;}

      /* Show the dropdown menu on hover */
      .dropdown:hover .dropdown-content {display: block;}

      /* Change the background color of the dropdown button when the dropdown content is shown */
       /*.dropdown:hover .dropbtn {background-color: #3e8e41;} */
    
    </style>
  </head>
  <body>
  <header class="main-header">

        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php"><img src="images/mylogo.png" class="logo" alt="logo"></a>
                </div>
                <!-- End Header Navigation -->
              
                <div class="search">
                <form class="example" action="search.php" method="POST">
                <input type="text" placeholder="Search" name="search">
                <button type="submit"  name="submit-search"><i class="fa fa-search"></i></button>
                </form>
                 </div>

                


                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                      
                        <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item "><a href="category.php" class="nav-link">Category</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="service.php">Our Service</a></li>

                       

                        <!-- Checking if user is already logged-in using the fname variable in Session Variable
                             If user is already logged in Then only he will be alble to access the cart, otherwise 
                             the user won't be allowed to. -->
                        <?php  if (isset($_SESSION['fname'])){?>
                        <a class="nav-link" href="cart.php">
                              <i class="fas fa-shopping-cart fa-2x"></i>
                              <?php 
                              if (isset($_SESSION['cart'])) {
                                  $count = count($_SESSION['cart']);
                                  echo '<div class="badge qty">'.$count.'</div>';
                              }else {
                                  echo '<div class="badge qty">0</div>';
                              }
                              ?>
                      </a>
                       <?php }else{ ?>  
                        <i class="fas fa-shopping-cart fa-2x px-3"></i>
                        
                        <?php } ?>
                    </ul>
                    
                      
                </div>

                

                <?php 
                // Checking is user is logged in
                if (isset($_SESSION['fname'])) {
                    //then the system shall display the Username and the capability to Write-Reviews and to Log-Out
                    echo ' 
                    <div class="dropdown">
                      <button class="dropbtn">Hello '.$_SESSION['fname'].'</button>
                      <div class="dropdown-content">
                        <a href="log_out.php">Log Out</a>
                        <a href="write_reviews.php">Review website</a>
                        <a href="prod_reviews.php">Review products</a>
                        <a href="updateAcc.php">Update Account</a>
                      
                      </div>
                    </div>';
                }else {
                    //IF the user in not logged-in, the system will Allow the user to Log-in or the Register
                    echo '<div class="dropdown">
                    <button class="dropbtn">My Account</button>
                    <div class="dropdown-content">
                      <a href="login_form.php"><i class="fa fa-sign-in" aria-hidden="true" ></i>  Log-In</a>
                      <a href="register.php"><i class="fa fa-user-plus" aria-hidden="true"></i>   Register</a>
                    
                    </div>
                  </div>';
                }
            
            
            ?> 
            </div>
            
        </nav>
        <!-- End Navigation -->
    </header>




    <!-- Optional JavaScript; choose one of the two! -->

    

  </body>
</html>