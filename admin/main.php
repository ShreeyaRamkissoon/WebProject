<!DOCTYPE html>
<?php 
   require_once "include/db_connect.php";
?>
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

      <style>
      

      #products{
         position: absolute;
         top: 20px;
         right: 35px;
         width: 164vh;
         height: 300px;
         overflow: auto;
         font-size: 15px;
         background-color: black;
         border-radius: 5px;
         color: white;
         
      }
      #products::-webkit-scrollbar {
         display: none;
      }

      #category{
         
         position: absolute;
         top:  350px;
         right: 565px;
         width: 80vh;
         height: 275px;
         font-size: 15px;
         margin-bottom: 100px;
         background-color: black;
         border-radius: 5px;
         color: white;
      }

      #brand{
         position: absolute;
         top:  350px;
         right: 100px;
         width: 40vh;
         height: 275px;
         font-size: 15px;
         margin-bottom: 100px;
         background-color: black;
         border-radius: 5px;
         color: white;
      }

     
      </style>
      
   </head>
   <body>
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

   
  <!-- User Details -->
   <div id="products">
   <h5 style="text-align: center;">User Details</h5>
         <table class="table table-hover table-sm table-dark table-striped">
      <thead>
         <tr>
            <th scope="col">User ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
            <th scope="col">Contact</th>
            <th scope="col">Address</th>
            <th scope="col">City</th>
         </tr>
      </thead>
      <tbody>
          <!--<tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            
         </tr> -->
         
         <!-- PHP To find User Details-->
         <?php 
            $sQuery = "SELECT * FROM customer";
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $result = $conn->query($sQuery);
            while($userResult = $result->fetch(PDO::FETCH_ASSOC)){  
         ?>
         <tr>
            <th><?php echo $userResult['cust_id']?></th>
            <td><?php echo $userResult['fname']?></td>
            <td><?php echo $userResult['lname']?></td>
            <td><?php echo $userResult['gender']?></td>
            <td><?php echo $userResult['email']?></td>
            <td><?php echo $userResult['password']?></td>
            <td><?php echo $userResult['phone']?></td>
            <td><?php echo $userResult['street']?></td>
            <td><?php echo $userResult['city']?></td>
         </tr>
         <?php 
            }
         ?>
      </tbody>
      </table>
   </div>
  
   <!-- Category Details -->
   <div id="category">
      <h5 style="text-align: center;">Category</h5>
   <table class="table table-hover table-sm table-dark table-striped">
      <thead>
         <tr>
            <th scope="col">User ID</th>
            <th scope="col">First Name</th>
         </tr>
      </thead>
      <tbody>
          <!--<tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            
         </tr> -->
         
         <!-- PHP To find User Details-->
         <?php 
            $sQuery = "SELECT * FROM category";
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $result = $conn->query($sQuery);
            while($userResult = $result->fetch(PDO::FETCH_ASSOC)){  
         ?>
         <tr>
            <th><?php echo $userResult['category_id']?></th>
            <td><?php echo $userResult['cname']?></td>

         </tr>
         <?php 
            }
         ?>
      </tbody>
      </table>
   </div>

   <div id="brand">
      <h5 style="text-align: center;">Brand List</h5>
      <table class="table table-hover table-sm table-dark table-striped">
      <thead>
         <tr>
            <th scope="col">Brand ID</th>
            <th scope="col">Name</th>
         </tr>
      </thead>
      <tbody>
          <!--<tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            
         </tr> -->
         
         <!-- PHP To find User Details-->
         <?php 
            $sQuery = "SELECT * FROM brand";
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $result = $conn->query($sQuery);
            while($userResult = $result->fetch(PDO::FETCH_ASSOC)){  
         ?>
         <tr>
            <th><?php echo $userResult['brand_id']?></th>
            <td><?php echo $userResult['bname']?></td>

         </tr>
         <?php 
            }
         ?>
      </tbody>
      </table>

   </div>
      

   </body>
</html>