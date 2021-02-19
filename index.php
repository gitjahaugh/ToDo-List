<?php 
require_once('database.php');

// Get all tasks
$query =  'SELECT * 
            FROM todoitems
            ORDER BY ItemNum';
$statement = $db->prepare($query);
$statement->execute();
$todoitems = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <section class="top">
    <header>
        <h1>ToDo List</h1>
    </header>
    <main>
        <?php if(!empty($todoitems)) { ?>
            <?php foreach ($todoitems as $item) : ?>
                <div class="items">
                    <p class ="bold"><?php echo $item['Title']; ?></p>
                    <p><?php echo $item['Description']; ?></p>
                </div>
                <div class="clear">
                    <form action="delete_item.php" method="POST">
                    <input type="hidden" name="item_num" value="<?php echo $item['ItemNum']; ?>">
                    <button class="remove">X</button>
                    </form>
                </div>
                <?php endforeach; ?>
        <?php } else { ?>
        <p>No to do list items exist yet.</p>
        <?php } ?>
    </section>

        <section class="add_form">
            <h2>Add Task</h2>
            <form action="add_item.php" method="POST" id="add_item_form">
                <input type="text" name="title" placeholder="Title" requiredd/><br>
                <input tyep="text" name="description" placeholder="Description" required/>
                <button class="add">Add Task</button>
            </form>
        </section>
    </main>    
</body>
</html>