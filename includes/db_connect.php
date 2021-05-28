<?php 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "musicshop";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db_name",$username,$password);
    } catch (PDOException $e) {
        echo "<br>".$e->getMessage();
        die;
    }


?>