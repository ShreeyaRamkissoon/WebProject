<?php 

    session_start();
    

    if(isset($_POST))
    {
        //require_once "include/db_connect.php";
        $userError ="";
        $pwdError = "";
    

	    $user_name = $_POST['user'];
        $password = $_POST['pwd'];
        //echo $user_name ." ". $password."<br>";

        if(empty($user_name)){
            $userError = "Please Enter your Username <br>";
        }
        if(empty($password)){
            $pwdError = "Please Enter your Password";
        }

       
        if(empty($userError) && empty($pwdError)) {
           
            require_once 'db_connect.php';
           
            $sQuery = "SELECT * FROM admin WHERE admin_fname = '$user_name'";

            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          
            //Executing Query and storing data into result
            $result = $conn->query($sQuery);

           ;
            $userResult = $result->fetch(PDO::FETCH_ASSOC);

            if(isset($userResult['admin_fname'])){
                //if username exists
                $pwd = $userResult['admin_password'];
                
                if ($pwd == $_POST['pwd']){
                    //$_SESSION['fname'] = $name;
                   //echo '<script>window.location="index.php"</script>';
                   echo 'Login Successfull';
                   $_SESSION['admin'] = $userResult['admin_fname']; // Assigning Admin name in Session for login Successfull
                   
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