<?php
require('database.php');

// Get ID
$item_num = filter_input(INPUT_POST, 'item_num', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($item_num) {
    $query = 'DELETE FROM todoitems 
              WHERE ItemNum = :item_num';
    $statement = $db->prepare($query);
    $statement->bindValue(':item_num', $item_num);
    $success = $statement->execute();
    $statement->closeCursor();    
}

// Display the To Do List page
include('index.php');
?>