<?php
// Get the to do item data
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

// Validate inputs
if ($title && $description) {
    require('database.php');

    // Add the item to the database  
    $query = 'INSERT INTO todoitems 
                 (Title, Description)
              VALUES
                 (:title, :descr)';
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':descr', $description);
    $statement->execute();
    $statement->closeCursor();
    
    // Display the To Do List page
    include('index.php');
} else {
    $error_message = "Invalid to do item data. Check all fields and try again.";
    include('error.php');
}

?>