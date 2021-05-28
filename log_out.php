<?php if(!isset($_SESSION)){
    session_start();
    session_destroy();
}else{
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <?php include_once 'header.php'; ?>
        <div class="containter justify-content text-center">
            <div class="jumbotron">
                <h1> You Have Successfully Logged-Out</h1>
            </div>
        </div>
        <?php include 'footer.php' ?>
    </body>
</html>