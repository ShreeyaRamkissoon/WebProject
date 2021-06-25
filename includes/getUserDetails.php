<?php 
    require '../vendor/autoload.php';
    if (!isset($_SESSION)) {
        session_start();
    }

    $userID = $_SESSION['user_id'];

    include 'db_connect.php';
    $Query = "SELECT * FROM customer WHERE cust_id = $userID";
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     $result = $conn->query($Query);

    $array_result = $result->fetchAll(PDO::FETCH_ASSOC);
    
     //var_dump($array_result);
    header('Content-Type: application/json; charset=utf-8');
    $data = json_encode($array_result,JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);
     

    use Opis\JsonSchema\{
        Validator,
        ValidationResult,
        Errors\ErrorFormatter,
    };
    
    // Create a new validator
    $validator = new Validator();
    
    // Register our schema
    $validator->resolver()->registerFile(
        'http://example.com/example.json', 
        'C:\xampp\htdocs\WebDesign\includes\getUserDetails_Schema.json'
    );
    
    // Decode $data
    $data1 = json_decode($data);
    
    /** @var ValidationResult $result */
    $result = $validator->validate($data1, 'http://example.com/example.json');
    
    if ($result->isValid()) {
        //echo "Valid", PHP_EOL;
        echo $data;
    } else {
        // Print errors
        print_r((new ErrorFormatter())->format($result->error()));
    }

?>