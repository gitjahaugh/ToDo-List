<?php
    // Define variables
    $newtitle = filter_input(INPUT_POST, 'newtitle', FILTER_SANITIZE_STRING);
    $newdescription = filter_input(INPUT_POST, 'newdescription', FILTER_SANITIZE_STRING);

    $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_GET, 'description', FILTER_SANITIZE_STRING);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <main>
        <section class="list">
        <header>
            <h1>ToDo List</h1>
        </header>
        <?php if(!$title && !$newtitle) { ?>
                <table>
                    <tr>
                        <td>Title <br> Description</td>
                        <td><button class="tablebutton">Delete</button></td>
                    </tr>
                </table>
        </section>

            <section>
                <h2>Add Item</h2>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <input type="text" id="newtitle" name="newtitle" placeholder="Title" required>
                <input type="text" id="newdesccription" name="newdescription" placeholder="Description" required>
                <button>Submit</button>
            </section>
            <?php } else { ?>
                <?php require('database.php'); ?>

                <?php 
                    if ($newtitle) {
                        $query = 'INSERT INTO todoitems
                                        (Title, Description)
                                    VALUES
                                        (:newtitle, :newdescription)';
                        $statement = $db->prepare($query);
                        $statement->bindValue(':newtitle', $newtitle);
                        $statement->bindValue(':newdescription', $newdescription);
                        $statement->execute();
                        $statement->closeCursor();
                    }

                    if ($title || $newtitle); {
                    $query = 'SELECT * FROM todoitems
                                WHERE Title = :title
                                ORDER BY ItemNum';
                        $statement = $db->prepare($query);
                        if ($title) {
                            $statement->bindValue(':title', $title);
                        } else {
                            $statement->bindValue(':city', $newtitle);
                        }
                        $statement->execute();
                        $results = $statement->fetchAll();
                        $statement->closeCursor();
                    }
                ?>
            <?php } ?>
    </main>
</body>
</html>;