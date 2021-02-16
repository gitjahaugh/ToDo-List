<?php
    // Create connection link to database
    $dsn = 'mysql:host=localhost;dbname=todoitems';
    $username = 'root';
    $password = 'sesame';

    // Throw error if connection to databse doesn't work
    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = 'Database Error: ';
        $error_message .= $e->getMessage();
        echo $error_message;
        exit();
    }
?>