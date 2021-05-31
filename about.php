<?php 
    if (!isset($_SESSION)) {
        session_start();
    }
    include_once'includes/db_connect.php';
    //Test

?>
<html>
    
    <head>
        <title>About Us</title>
        <meta http-equiv="x-ua-compatible" content="IE=edge">

        <style>
            .wrapper{
                padding-top: 120px;
            }

            .card-img-top{
                box-shadow: 0 5px 10px rgba(0,0,0,0,5);

            }
        </style>

            <!-- script for google maps -->
<script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBW4DAn1sxKvnScMUO8nJFn0Y-fwzzv6Pg&callback=initMap">
</script>
   

    <style type="text/css">
      /* Set the size of the div element that contains the map */
      #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
      }
    </style>
  
  <!-- -->
    <script>
      // Initialize and add the map
      function initMap() {
        // The location of myloc
        const myloc = { lat: -20.232251050000002, lng: 57.49865244965149 };
        // The map, centered at myloc
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 4,
          center: myloc,
        });
        // The marker, positioned at myloc
        const marker = new google.maps.Marker({
          position: myloc,
          map: map,
        });
      }
    </script>
    
    </head>

    <body>
        <?php include 'header.php'; ?> <!-- header of page -->

        

        <figure>
            <img src="images/about.png" alt="About" style="width:100%;height:70%">
            <figcaption style="background-color: DimGrey; color: white;font-style: bold;padding: 20px;text-align: center;"><h1>About Us</h1></figcaption>
        </figure>
        

        <!--container using bootstrap -->
        <div class="container">
             <br>
             <br>
               <h1>TheMusicShop</h1>
               <p>Established in 2020, TheMusicShop is the one and only online leading retailer of musical instruments in Mauritius.
               Given the fact that there is a lack of music shops in Mauritius and that most citizens are either
               focused on their academic life or their career, very little to no importance is given to music. Music has a significant 
               role in our life in terms of expressing our emotions and relieving stress. 
               Hence, with a passionate commitment to making gear easy-to-buy, TheMusicShop is all about enabling musicians and 
               non-musicians alike to experience the almost indescribable joy that comes from playing an instrument.  </p>
              <br>
              <h4>Contact Info:-</h4><!-- contact info -->
                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt" style="margin-left:0px;margin-right:10px;"></i>Address: Reduit, Moka, Mauritius </p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square" style="margin-left:0px;margin-right:10px;"></i>Phone: <a href="tel:+1-888705770">+1-888 705 770</a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope" style="margin-left:0px;margin-right:10px;"></i>Email: <a href="mailto:sulakshna.ramkisssoon@umail.uom.ac.mu.com">contactinfo@gmail.com</a></p>
                                </li>
                            </ul>
        </div>

        <br><br>

        <!-- Details on Administrators/staff  -->
        <div class="container">
                    <div class="row text-center justify-content-center">
                        <div class="col-md-6 col-lg-4">
                            <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="images/man.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Jeremy Castor</h5>
                                    <p class="card-text">President of Business Solutions</p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card" style="width: 18rem;height:100%">
                            <img class="card-img-top" src="images/woman.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Sulakshna Ramkissoon</h5>
                                    <p class="card-text">Sales Associate</p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
        </div>

     <br><br>


       <h3 style="text-align: center;">Our Location</h3>
    <!--The div element for the map -->
    <div id="map"></div>
       
    


        <?php include 'footer.php'; ?>  <!--footer of page-->
    
    </body>


</html>