<?php include 'header.php' ?>


<?php
    if (!isset($_SESSION)) {
        session_start();
    }
     $name = $passWord = "";
     $ERRORName = $ERRPassWord =  "";

     if ($_SERVER["REQUEST_METHOD"] == 'POST') {

         if(empty($_POST['uname'])){
             $ERRORName = "Invalid First Name ";
         }else{
            $name = $_POST['uname'];
         }

         if(empty($_POST['password'])){
             $ERRPassWord = "Please Enter the Password";
         }else {
            $passWord = $_POST['password'];
         }


         if (empty($ERRORName) && empty($ERRPassWord)) {
           
             require_once 'includes/db_connect.php';
            

             $sQuery = "SELECT * FROM customer WHERE username = '$name'";

             $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
             //Executing Query and storing data into result
             $result = $conn->query($sQuery);

             $userResult = $result->fetch(PDO::FETCH_ASSOC);

             
             if(isset($userResult['username'])){
                 //if username exists
                 if ($userResult['password'] == $passWord) {
                    $_SESSION['fname'] = $name;
                    echo '<script>window.location="index.php"</script>';
                 }else {
                     $Msg = "You Entered the wrong Password. Please try again";
                     echo $Msg;
                 }

             }else{
                 $Msg = "User Name Error: Check your Credentials";
                 echo $Msg;
             }
         }
     }
?>

<style>           
        .xcontainer{
            margin-top: 20px;
            margin-left: 30%;
            margin-right: 30%;     
            }
        .error{
            color: rgb(255, 63, 71);
            font-size: 15px;
        }
        .fm_header{
            text-align: center;
            margin-bottom: 20px;
        }
        
</style>
    

<?php 
    if(isset($_SESSION['fname'])){
        echo 'You are Already Logged in ';
    }else {
?>
    <div class = "jumbotron xcontainer">
        <h2 class = "fm_header">Login Here</h2>
        <form  class="form-group" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
            <div class = "form-group">
                <label for="username">Username:</label>
                <input class ="form-control" type="text" name="uname" id="username" placeholder="Enter your Name">
            </div>
            <div class = "form-group">
                <label for="passw">Password:</label>
                <input class ="form-control" type="password" name="password" id="passw" placeholder="Enter your Password">
            </div>
            <div class="col text-center">
                <input value="Log In" type="submit" class="btn btn-primary">
            </div>

        </form>


    </div>
<?php 
    }
?>
<?php include 'footer.php' ?>

