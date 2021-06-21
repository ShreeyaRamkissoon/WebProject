<!DOCTYPE html>
<html lang="en">
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
     
        <link rel="stylesheet" type="text/css"  title="Navbar Css" href="css/style2.css">
        <script src="https://kit.fontawesome.com/ac005c1be0.js" crossorigin="anonymous"></script>

        <title>Add Product</title>

        <style>
            body{
                overflow: visible;
            }

            nav#navigation_bar{
                height: 100%; /* Full height */
                position: fixed; /* Make it stick, even on scroll */
                overflow: auto
            }
            #addProduct{
                position: absolute;
                top: 30px;
                right:300px;
                width: 75vh;
                height: 750px;
                font-size: 15px;
                background-color: rgb(0, 0, 0);
                padding: 10px;
                color: white;
                
            }

            #updateProducts{
                position: absolute;
                top: 850px;
                right: 300px;
                width: 80vh;
                height: 600px;
                font-size: 15px;
                background-color: rgb(0, 0, 0);
                padding: 10px;
                color: white;
            }

            #removeProducts{
                position: absolute;
                top: 1750px;
                right:400px;
                width: 80vh;
                height: 400px;
                font-size: 15px;
                background-color: rgb(0, 0, 0);
                padding: 10px;
                color: white;

            }

            div#content{
                position: absolute;
                top: 1750px;
                right: 100px;
                width: 40vh;
                height: 300px;               
            }


            
        </style>

        <script>

            //Categoty List
            var obj_json ;
            var url = "include/getCategory.php";
            $.getJSON( url, function(data) {
               
                    obj_json = data;
                    //Let us populate the drop down list
                    //Reference https://www.codebyamir.com/blog/populate-a-select-dropdown-list-with-json
                    $.each(data, function (key, entry) {
                    $("select#category").append($('<option></option>').attr('value', entry.category_id).text(entry.cname));
                    });
                	
            });

            //Brand List
            var obj_json2 ;
            var url2 = "include/getBrand.php";
            $.getJSON( url2, function(data2) {
               
                    obj_json2 = data2;
                    //Let us populate the drop down list
                    //Reference https://www.codebyamir.com/blog/populate-a-select-dropdown-list-with-json
                    $.each(data2, function (key, entry2) {
                    $("select#brand").append($('<option></option>').attr('value', entry2.brand_id).text(entry2.bname));
                    });
                	
            });

            //Product List
            var obj_json3 ;
            var url3 = "include/getProducts.php";
            $.getJSON( url3, function(data3) {
               
                    obj_json3 = data3;
                    //Let us populate the drop down list
                    //Reference https://www.codebyamir.com/blog/populate-a-select-dropdown-list-with-json
                    $.each(data3, function (key, entry3) {
                    $("div#updateProducts select#products").append($('<option></option>').attr('value', entry3.prod_id).text(entry3.pname));
                    $("div#removeProducts select#products").append($('<option></option>').attr('value', entry3.prod_id).text(entry3.pname));
                    });
                	
            });

            $(document).ready(function(){

                $(document).on('change' ,"div#updateProducts select#products", function(){
                    console.log();
                    var proID = $(this).val();

                    $.each(obj_json3, function (key, entry4) {
                        if(entry4.prod_id == proID){
                            $('input#UPname').val(entry4.pname); 
                            $('textarea#UPdescription').val(entry4.description);
                            $('input#UPprice').val(entry4.price);
                            $('input#UPquantity').val(entry4.instock);
                            $('#updateProducts select#category').val(entry4.category_id);
                            $('#updateProducts select#brand').val(entry4.brand_id);
                            $('#updateProducts input#imgPath').val(entry4.image);
                        }
                    });
                });

                //Removing Products
                $(document).on('change','div#removeProducts select#products', function(){
                    //console.log($(this).val());
                    var ID = $(this).val();
                    var img_path = "../images/";
                    $.each(obj_json3, function (key, entry5) {
                        if(entry5.prod_id == ID){
                            img_path = img_path + entry5.image;
                            //console.log(img_path);
                        }

                    });

                    $('div#content img').attr("src",img_path);
                   
                });

                $(document).on('click',"button#buttonRemove",function(){
                    var prodID =  $("div#removeProducts select#products").val();
                    //console.log(prodID);

                    var url = "http://localhost/WebProject_WebServices/admin/remove/" + prodID;
                    $.ajax({
                        url: url,
                        //accepts: "application/json",
                        headers:{Accept:"application/json" },
                        
                        method: "POST", 
                        data:{},
                        error: function(xhr){
                            
                                alert("An error occured: " + xhr.status + " " + xhr.statusText);
                        }
                    })
                    .done(function(data)
                    {	
                        //$("span#createresult").html();
                        $("#errorModal p#errorText").html("Product removed successfully");
                        $("#errorModal").modal();
                    })//.done(function(data)
                    ;//$.ajax({
                });


                //Creating Products WEB_SERVICE
                $(document).on('click',"#buttonSub",function(){
                    
                    var fileInput = document.getElementById('fileChooser');   
                    var filename = fileInput.files[0].name;
                   
                    var pname = $('input#name').val();
                    var description = $("textarea#description").val();
                    var price = $('input#price').val();
                    var quantity = $('input#quantity').val();
                    var category = $('select#category').val();
                    var brand = $('select#brand').val();
                    

                    //console.log(quantity);

                    var url = "http://localhost/WebProject_WebServices/admin/create/";
		
                    $.ajax({
                        url: url,
                        //accepts: "application/json",
                        headers:{Accept:"application/json" },
                        
                        method: "POST", 
                        data:{  pname:pname,
                                price:price,
                                description:description,
                                quantity:quantity,
                                category:category,
                                brand:brand,
                                img:filename
                        },
                        error: function(xhr){
                            
                                alert("An error occured: " + xhr.status + " " + xhr.statusText);
                        }
                    })
                    .done(function(data)
                    {	
                        //$("span#createresult").html();
                        $("#errorModal p#errorText").html("New Product added successfully");
                        $("#errorModal").modal();
                    })//.done(function(data)
                    ;//$.ajax({
                    


                });


                //Click on Update Button
                $(document).on('click','button#buttonUpdate',function(){
                    //console.log("Button Clicked");
                    var pname =  $('input#UPname').val(); 
                    var descrip =  $('textarea#UPdescription').val();
                    var price = $('input#UPprice').val();
                    var quantity = $('input#UPquantity').val();
                    var cat = $('#updateProducts select#category').val();
                    var brand = $('#updateProducts select#brand').val();
                    var prodID = $("div#updateProducts select#products").val();
                    var img = $('#updateProducts input#imgPath').val();

                    //console.log(pname + " " + descrip + " " + price + " " + quantity + " " +cat + " " + brand);
                    var url = "http://localhost/WebProject_WebServices/admin/update/" + prodID ;
		
                    $.ajax({
                        url: url,
                        //accepts: "application/json",
                        headers:{Accept:"application/json" },
                        
                        method: "POST", 
                        data:{  pname:pname,
                                price:price,
                                description:descrip,
                                quantity:quantity,
                                category:cat,
                                brand:brand,
                                img:img

                        },
                        error: function(xhr){
                            
                                alert("An error occured: " + xhr.status + " " + xhr.statusText);
                        }
                    })
                    .done(function(data)
                    {	
                        //$("span#createresult").html();
                        $("#errorModal p#errorText").html("Product Updated Sucessfully");
                        $("#errorModal").modal();
                    })//.done(function(data)
                    ;//$.ajax({
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
      <a class="nav-link" href="adduser.php">Add User</a>
      <a class="nav-link" href="productlist.php">Product List</a>
      <a class="nav-link" href="orders.php">Orders</a>
      <a class="nav-link" href="addproduct.php">Manage Products</a>
      <a class="nav-link" href="#">Manage User</a>
      <a class="nav-link" href="#">Log Out</a>
    </nav>

    
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

    <div id="addProduct">
           
            <h2 style="text-align: center;">Add Product</h2>

            <form method="post">
          

                    <label  for="name">Product Name :</label>
                    <input class="form-control input-borders" placeholder="Ultimate Guitar" id="name" >

                    <br>
                    <label for="exampleFormControlTextarea1">Product Description</label>
                    <textarea class="form-control" maxlength="255" id="description" placeholder="Enter Description Here"  rows="3"></textarea>


                    <br>
                    <label for="email">Product Price</label>                           
                    <input class="form-control input-borders" placeholder="Rs ...."  id="price" >

                    <br>
                    <label for="password">Quantity</label>                        
                    <input class=" form-control input-borders"placeholder="Quantity" id="quantity" >
                    <br>
                    <label for="exampleFormControlSelect1">Select Category</label>
                    <select class="form-control" id="category" style="color:black">
                    
                    </select><br>

                    <label for="exampleFormControlSelect1">Select Brand</label>
                    <select class="form-control" id="brand">                    
                    </select><br>

                    <label for="exampleFormControlFile1">Product Image</label>
                    <input type="file" class="form-control-file" id="fileChooser"><br>

                    <div class=" col text-center">
                        <button type="button" class="btn" style="background-color: rgb(179, 82, 179); color:white;" id="buttonSub">Add Admin</button>
                    </div>
            </form>
        
        </div>

        <div id="updateProducts">
           
            <h2 style="text-align: center;">Update Product</h2>

            <form method="post">
          
                    <label for="exampleFormControlSelect1">Select Products</label>
                    <select class="form-control" id="products">                    
                    </select><br>


                    <label  for="name">Product Name :</label>
                    <input class="form-control input-borders"  id="UPname" >

                    <br>
                    <label for="exampleFormControlTextarea1">Update Description</label>
                    <textarea class="form-control" maxlength="255" id="UPdescription" placeholder="Enter Description Here"  rows="3"></textarea>


                    <br>
                    <label for="email">Update Price</label>                           
                    <input class="form-control input-borders" placeholder="Rs ...."  id="UPprice" >

                    <br>
                    <label for="password">Update Quantity</label>                        
                    <input class=" form-control input-borders" id="UPquantity">
                    <br>
                    <label for="exampleFormControlSelect1">Change Category (Update Category if Needed)</label>
                    <select class="form-control" id="category" style="color:black">
                    
                    </select><br>

                    <label for="exampleFormControlSelect1">Select Brand (Update Brand if Needed)</label>
                    <select class="form-control" id="brand">                    
                    </select><br>

                    <input type="hidden" class=" form-control input-borders" id="imgPath">

                    <!--<label for="exampleFormControlFile1">Product Image</label>
                    <input type="file" class="form-control-file" id="fileChooser"><br> -->

                    <div class=" col text-center">
                        <button type="button" class="btn" style="background-color: rgb(179, 82, 179); color:white;" id="buttonUpdate">Update Product</button>
                    </div>
            </form>
        
        </div>

        <!-- //////////////////////////////////////////////// REMOVE PRODUCT ///////////////////////////// -->
        <div id="removeProducts">
           
            <h2 style="text-align: center;">Remove Product</h2>

            <form method="post">
          
                    <label for="exampleFormControlSelect1">Select Products</label>
                    <select class="form-control" id="products">                    
                    </select><br>

                    

                    <div class=" col text-center">
                        <button type="button" class="btn" style="background-color: rgb(179, 82, 179); color:white;" id="buttonRemove">Remove Product</button>
                    </div>

                    
            </form>
        
        </div>

        <div id="content" class="card">
                        <img src="../images/mylogo.png" alt="Product" class="card-img" id="img">
        </div><br>

    </body>
</html>