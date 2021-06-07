<?php 

    if(isset($_POST)){
        $adm_name = $_POST['user'];
        $adm_email = $_POST['email'];
        $adm_lname = $_POST['lname'];
        $adm_password = $_POST['pwd'];
        
        $errName = "";
        $errlname = "";
        $erremail = "";
        $errpassword = "";
        if(empty($adm_name)){
            $errName = "Please enter Your Name<br>";
        }
        if(empty($adm_password)){
            $errpassword = "Please enter Your Password <br>";
        }
        if(empty($adm_lname)){
            $errlname = "Please enter Your Last Name<br>";
        }
        if(empty($adm_email)){
            $erremail = "Please enter Your Email<br>";
        }

        if(empty($errName) && empty($errpassword) && empty($errlname) && empty($erremail)){
            //echo 'Successfull';
            require_once "db_connect.php";

                $sInsert = $conn->prepare("INSERT INTO admin(admin_fname,admin_lname,admin_email,admin_password)
                    VALUES(:fname,:lname,:email,:password)");
                $sInsert->bindParam(':fname',$_POST['user']);
                $sInsert->bindParam(':lname',$_POST['lname']);
                $sInsert->bindParam(':email',$_POST['email']);
                $sInsert->bindParam(':password',$_POST['pwd']);
                


                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $result = $sInsert->execute();
                if ($result!=0) {
                    echo "Data Inserted Successfully";
                }else {
                    echo "ERROR OCCURED DURIING INSERTION";
                }

        }else {
            echo $errName  ." ". $errpassword ." ". $errlname ." ". $erremail ;
        }


    }





?>