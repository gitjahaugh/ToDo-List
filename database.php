<?php 
// Set dsn, user, and passrod for connection
$dsn = 'mysql:host=localhost;dbname=todolist';
$username = 'root';
$password = 'sesame';

// Connect to database with above variables
try {
    $db = new PDO($dsn, $username, $password);
    // If no connection to the database display error message
} catch (PDOExecption $e) {
    $error_message = $e->getMessage();
    inlcude('database_error.php');
    exit();
}

?>