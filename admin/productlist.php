<!DOCTYPE html>
<?php 
   require_once "include/db_connect.php";
?>
<html lang="en">
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
     
        <link rel="stylesheet" type="text/css"  title="Navbar Css" href="css/style2.css">
        <script src="https://kit.fontawesome.com/ac005c1be0.js" crossorigin="anonymous"></script>

        <title>View Product List</title>

        <style>
            #productlist{
                position: absolute;
                top: 20px;
                right: 20px;
                width: 170vh;
                height: 600px;
                font-size: 15px;
                background-color: rgb(0, 0, 0);
                padding: 10px;
                color: white;
                border-radius: 5px;
                overflow: auto;
            }
            img{
                transition: all .2s ease-in-out;
            }
            img:hover{
                transform: translateY(0) scale(5);
            }
        </style>

        <script>
            $(document).ready(function(){
                $(document).on("click","input#addInstock",function(){
                    var prodID = $(this).val();
                    alert("Addproduct in Stock" + prodID);
                });
                $(document).on("click","input#remove",function(){
                    var prodID = $(this).val();
                    alert("Remove Product" + prodID);
                });
            });
        </script>
    </head>
    <body>
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <!-- END OF BOOTSTRAP -->

        <nav class="nav flex-column" id="navigation_bar">
            <a class="nav-link" href="main.php" active ><i class="fas fa-columns fa-1.8x"></i>Dashboard</a>
            <a class="nav-link" href="adduser.php">Add Admin</a>
            <a class="nav-link" href="productlist.php">Product List</a>
            <a class="nav-link" href="#">Orders</a>
            <a class="nav-link" href="addproduct.php">Add Product</a>
            <a class="nav-link" href="#">Manage User</a>
            <a class="nav-link" href="#">Log Out</a>
        </nav>

        <div id="productlist">
            <h5 style="text-align: center; color:white">Product List</h5>
            <!-- Product List -->
                    <div id="products">
            
                            <table class="table table-hover table-sm table-dark table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Product ID</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Category</th>
                                <th scope="col">In Stock</th>
                                <th scope="col"></th>
                            
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
                                $sQuery = " SELECT p.prod_id, p.image,p.pname,p.price,category.cname ,p.instock
                                            FROM product p 
                                            LEFT JOIN category ON p.category_id = category.category_id";
                                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                                $result = $conn->query($sQuery);
                                while($userResult = $result->fetch(PDO::FETCH_ASSOC)){  
                            ?>
                            <tr>
                                <th><?php echo $userResult['prod_id']?></th>
                                <td><img id="img" style="width: 50px;" src="../images/<?php echo $userResult['image']?>"></td>
                                <td><?php echo $userResult['pname']?></td>
                                <td><?php echo $userResult['price']?></td>
                                <td><?php echo $userResult['cname']?></td>
                                <td><?php echo $userResult['instock']?></td>
                                <td>
                                    <input id="addInstock" type="image" src="../images/add.png" style="width: 25px;" value="<?php echo $userResult['prod_id']?>">  
                                    <input id="remove" type="image" src="../images/remove.png" style="width: 25px;" value="<?php echo $userResult['prod_id']?>">
                                </td>
                            </tr>
                            <?php 
                                }
                            ?>
                        </tbody>
                        </table>
                    </div>

        </div>
    
    </body>
</html>