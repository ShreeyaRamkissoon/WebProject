<?php 
    include 'header.php'; 
    require_once 'includes/db_connect.php';
?>

<?php 

        $fname = $lname = $email = $dateOB = $password = $npassword = $phoneNum = $addr = $city = $gender = $username = "";
        $ERRORName = $ERRLname = $ERRemail = $ERRdateOB = $ERRpassword = $ERRnpassword = $ERRphn = $ERRaddr = $ERRcity = $ERRGend = $ERRUserN ="";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = $_POST['f_name'];
            $lname = $_POST['l_name'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $dateOB = $_POST['dateOB'];
            $password = $_POST['fpassword'];
            $npassword = $_POST['cfpassword'];
            $phoneNum = $_POST['phnum'];
            $addr = $_POST['address'];
            $city = $_POST['city'];
            $username = $_POST['username'];

            //Validating First Name
            if(empty($fname)){
                $ERRORName = "Please enter your first Name ";
            }else {
                if(!preg_match("/^[A-Z][a-z]+( [A-Z][a-z]+)*$/",$fname))
                {
                    $ERRORName = "First name must contain alphabets only";
                }
            }

            //Validating Last Name
            if(empty($lname)){
                $ERRLname = "Please enter your first Name ";
            }else {
                if(!preg_match("/^[A-Z][a-z]+( [A-Z][a-z]+)*$/",$lname))
                {
                    $ERRLname = "Last Name must Contain alphabets only only";
                }
            }

            //Validating Email
            if(empty($email)){
                $ERRemail = "Please Enter your email address";
            }else {
                if (!preg_match( "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/",$email)) {
                    $ERRemail = "Invalid Email";
                }
            }

            //Validating Date of birth
            if(empty($dateOB)){
                $ERRdateOB = "Please Enter your date of birth ";
            }

            //Validating Password
            if(empty($password)){
                $ERRpassword = "Please Enter a Password ";
            }

            //Validating Confirm Passwordn
            if(empty($npassword)){
                $ERRnpassword = "Please Enter a Password ";
            }else {
                if($npassword != $password){
                    $ERRnpassword = "Password Does not match. Please type the same passord";
                }
            }
            
            if(empty($phoneNum)){
                $ERRphn = "Enter Your Phone Number";
            }else{
                if(strlen($phoneNum) != 8){
                    $ERRphn = "Invalid Phone Number";
                }
            }

            if(empty($city)){
                $ERRcity = "Enter the city you live in";
            }else {
                if(!preg_match("/^[A-Z][a-z]+( [A-Z][a-z]+)*$/",$city))
                {
                    $ERRcity = "Invalid City";
                }
            }
            
            if(empty($addr)){
                $ERRaddr = "Enter the Address";
            }else {
                if(!preg_match("/^[A-Z][a-z]+( [A-Z][a-z]+)*$/",$addr))
                {
                    $ERRaddr = "Invalid Address";
                }
            }

            if(empty($gender)){
                    $ERRGend = "Please Enter your Gender";
            }

            if(empty($username)){
                $ERRUserN = "Please Enter A Username";
            }
            


            if($ERRORName == "" && $ERRLname == "" && $ERRemail == "" && $ERRpassword =="" && $ERRnpassword == "" && $ERRdateOB == "" && $ERRphn == "" && $ERRaddr == ""){
                //Connecting to database
                
                echo 'inserting into database';

                //Inserting data into database using prepared statements
                $sInsert = $conn->prepare("INSERT INTO customer(fname,lname,gender,email,dob,password,phone,street,city,username)
                    VALUES(:fname,:lname,:gender,:email,:dob,:password,:phone,:street,:city,:username)");
                $sInsert->bindParam(':fname',$fname);
                $sInsert->bindParam(':lname',$lname);
                $sInsert->bindParam(':email',$email);
                $sInsert->bindParam(':password',$password);
                $sInsert->bindParam(':dob',$dateOB);
                $sInsert->bindParam(':phone',$phoneNum);
                $sInsert->bindParam(':street',$addr);
                $sInsert->bindParam(':city',$city);
                $sInsert->bindParam(':gender',$gender);
                $sInsert->bindParam(':username',$username);


                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sInsert->execute(); // Return the number for rows afected
               
                $conn==null;

                //adding username to Session Variable
                $_SESSION['fname'] = $username;
            }
        }

?>

<!DOCTYPE html>
<html lang="en">
<head> 

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

                .fm_header{
                    text-align: center;
                    margin-bottom: 20px;
                }

                .disp{
                    padding-top: 600px;
                }
                
        </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        if($ERRORName == "" && $ERRLname == "" && $ERRemail == "" && $ERRpassword =="" && $ERRnpassword == "" && $ERRdateOB == "" && $ERRphn == "" && $ERRaddr == "" && $_SERVER["REQUEST_METHOD"] == "POST"){
            //displaying Message
        ?>
                <div class="container">
                    <div class="row text-center justify-content-center">
                        <div class="col-7">
                        <div class="jumbotron">
                            <h1> Registration Successfull </h1><br>
                            <div><i class="fa fa-check-circle fa-4x"></i></div><br>
                            <br>
                           
                            <form action="category.php">
                                <input type="submit" value="Continue Shopping" class="btn btn-success" >
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
      <?php  
        }else{        
      ?>
      <div class="jumbotron xcontainer">
            <div class="fm_header">
                <h2>Register Here</h2>
                
            </div>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
               
                
                    <label  for="name">Enter you Name :</label>
                    <input class="form-control input-borders "<?php if(!empty($ERRORName)){echo 'style="border:1px solid #ff0000"';} ?> type="text" size="10" name="f_name" id="fname" placeholder="John" value="<?php echo $fname ?>" >
                    <span class="error"> <?php echo $ERRORName ?> </span>
                
                    <br>
                    <label for="lname">Last name :</label>
                    <input class="form-control input-borders" <?php if(!empty($ERRORName)){echo 'style="border:1px solid #ff0000"';} ?> type="text" name="l_name" id="lname" placeholder="Smith" value="<?php echo $lname; ?>">
                    <span class="error"> <?php echo $ERRLname ?> </span>

                    <br>
                    <label for="gender">Gender :</label><br>
                    <input type="radio" id="male" name="gender" value="male" <?php if($gender == 'male'){echo 'selected' ;} ?>>
                    <label for="male">Male</label><br>
                    <input type="radio" id="female" name="gender" value="female" <?php if($gender == 'female'){echo 'selected' ;} ?>>
                    <label for="female">Female</label><br>
                    <span class="error"> <?php echo $ERRGend ?> </span>
               
                    <br>
                    <label for="email">Email</label>                           
                    <input class="form-control input-borders" <?php if(!empty($ERRORName)){echo 'style="border:1px solid #ff0000"';} ?> type="email" name="email" id="email" placeholder="Something@email.com" value="<?php echo $email ?>">
                    <span class="error"> <?php echo $ERRemail ?> </span>
               

                    <br>
                    <label for=dob">Date of Birth</label>                         
                    <input class="form-control input-borders" <?php if(!empty($ERRORName)){echo 'style="border:1px solid #ff0000"';} ?> name="dateOB" type="date" value="<?php echo $dateOB ?>" id="dob" placeholder="2000-08-19">
                    <span class="error"> <?php echo $ERRdateOB ?> </span>

                    <br>
                    <label  for="uname">Enter your Username :</label>
                    <input class="form-control input-borders "<?php if(!empty($ERRORName)){echo 'style="border:1px solid #ff0000"';} ?> type="text" size="10" name="username" id="uname" placeholder="John" value="<?php echo $fname ?>" >
                    <span class="error"> <?php echo $ERRORName ?> </span>
               
                    <br>
                    <label for="password">Password</label>                        
                    <input class=" form-control input-borders" <?php if(!empty($ERRORName)){echo 'style="border:1px solid #ff0000"';} ?> type="password" value="<?php echo $password ?>" name="fpassword" id="password" placeholder="Password"  >
                    <span class="error"> <?php echo $ERRpassword ?> </span>
             
                    <br>
                     <label for="cpassword">Confirm Password</label>                         
                     <input class=" form-control input-borders" <?php if(!empty($ERRORName)){echo 'style="border:1px solid #ff0000"';} ?> type="password" value="<?php echo $npassword ?>" name="cfpassword" id="cpassword" placeholder="Password"  >
                     <span class="error"> <?php echo $ERRnpassword ?> </span>

                     <br>
                     <label for="pnum">Phone Number </label>                            
                    <input class=" form-control input-borders" <?php if(!empty($ERRORName)){echo 'style="border:1px solid #ff0000"';} ?> type="text" value="<?php echo $phoneNum?>"  name="phnum" id="pnum" placeholder="+230 XXX XXXX"  >
                    <span class="error"> <?php echo $ERRphn ?> </span>

                    <br>
                    <label for="address">Street </label>                         
                    <input class=" form-control input-borders" <?php if(!empty($ERRORName)){echo 'style="border:1px solid #ff0000"';} ?> type="text" value="<?php echo $addr ?>" name="address" id="address" placeholder="First Name"  >
                    <span class="error"> <?php echo $ERRaddr ?> </span>
                    
                    <br>
                    <label for="city">City </label>                           
                    <input class=" form-control input-borders" <?php if(!empty($ERRORName)){echo 'style="border:1px solid #ff0000"';} ?> type="text" value="<?php echo $city ?>" name="city" id="city" placeholder="Réduit"  >
                    <span class="error"> <?php echo $ERRcity ?> </span>
                
            

                
                <div class=" col text-center">
                    <input type="submit" class="btn btn-primary">
                </div>
                
            
            </form>
        
        </div>
      <?php      
        }
       ?>
       <?php include 'footer.php' ?>
</body>
</html>




        
        
    
 
       
        
        
        
        
       
    



