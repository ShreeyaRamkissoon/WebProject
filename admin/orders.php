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
      
    <title>Orders List</title>

    <style>
            body{
                overflow: visible;
            }

            nav#navigation_bar{
                height: 100%; /* Full height */
                position: fixed; /* Make it stick, even on scroll */
                overflow: auto
            }

            #orders{
                position: absolute;
                top: 75px;
                right: 150px;
                width: 60vw;
                height: 250px;
                font-size: 15px;
                background-color: rgb(0, 0, 0);
                padding: 10px;
                color: white;
                border-radius: 5px;
                overflow: auto;
            }
            #orders::-webkit-scrollbar {
                display: none;
            }

            div#map{
                position: absolute;
                width: 75vw;
                right: 35px;
                height: 300px;
                bottom: 5px;
                z-index: 1;
                padding-bottom: 10px;
                

            }
    </style>

    <script>
        

        var table_str;
        var obj_json ;
        var url = "include/getOrders.php";
        $.getJSON( url, function(data) {
               
                obj_json = data;
                    //Let us populate the drop down list
                    //Reference https://www.codebyamir.com/blog/populate-a-select-dropdown-list-with-json
                    $.each(data, function (key, entry) {
                        table_str = table_str + "<tr>"
                        table_str = table_str + "<td>" + entry['fname'] + "</td>" ;   
                        table_str = table_str + "<td>" + entry['lname'] + "</td>";
                        table_str = table_str + "<td>" + entry['date_purchase'] + "</td>";  
                        table_str = table_str + "<td>" + entry['pname'] + "</td>";  
                        table_str = table_str + "<td>" + entry['image'] + "</td>";
                        table_str = table_str + '<td><input type="button" class="btn mapBtn"  id = "'+ entry['cust_id']+'" value="View Delivery Location" style="background-color:grey;"></td>';
                        table_str = table_str + "</tr>"
                    });
                    //console.log(table_str);
                    $('div#orders tbody').html(table_str);
         });

         

         $(document).ready(function(){
            
            
             $(document).on('click','input.mapBtn' , function(){
                var id = $(this).attr('id');
                var lat ;
                var lng ;
                //console.log("Button Clicked")
                
                var url = "include/getLocation.php";
                    $.ajax({
                        url: url,
                        //accepts: "application/json",
                        headers:{Accept:"application/json" },
                        method: "POST", 
                        data:{cust_Id: id},
                        error: function(xhr){
                            
                                alert("An error occured: " + xhr.status + " " + xhr.statusText);
                        }
                    })
                    .done(function(data)
                    {	
                        $.each(data, function(key,entry){
                            lat = entry['lattitude'];
                            lng = entry['longitude'];
                        });
                        
                        initMap(lat,lng);
                        //console.log(lat + "  " + lng);
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
        <h1 style="text-align: center; color:white;">Orders List</h1>

        <div id="orders">
                <table class="table table-hover table-sm table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Date of purchase</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Image</th>
                        </tr>
                    </thead>
                     <tbody>
                        <!-- Table Data -->
                    </tbody>
                </table>          
                        
        </div>

        <div id="map" class="map" ></div>

        <script>
            function initMap(lattitude,longitude){
               
                var latt = lattitude;
                var long = longitude;
                
                //var location = {lat: -20.233237,lng: 57.499630};
                var location = {lat: latt,lng:long};
                var map = new google.maps.Map(document.getElementById("map"),{
                    zoom: 12,
                    center: location
                }); 
                var marker = new google.maps.Marker({
                    position: location,
                    map:map
                })
            }
            function initiateMap(){
               
               
               var location = {lat: -20.233237,lng: 57.499630};
               
               var map = new google.maps.Map(document.getElementById("map"),{
                   zoom: 6,
                   center: location
               });
           }
        </script>

        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiK3O84HUXz9RjsjKY7iXRybFwc5YrskU&callback=initMap"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiK3O84HUXz9RjsjKY7iXRybFwc5YrskU&callback=initiateMap"></script>
         

        


</body>
</html>