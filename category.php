<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>list category</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container" py-2>    
    <h2>List of category</h2>
    <a href="add_category.php" class="btn btn-primary">Add category</a>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require_once 'include/database.php';
            $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
            foreach ($categories as $categorie){
            ?>
            <tr>
                <td><?php echo $categorie['id'] ?></td>
                <td><?php echo $categorie['name'] ?></td>
                <td><?php echo $categorie['description'] ?></td>
                <td><?php echo $categorie['date_creation'] ?></td>
                <td>
                    <a href="Edit_category.php?id=<?php echo $categorie['id'] ?>" class="btn btn-primary">Edit</a>
                    <a href="Delete_category.php?id=<?php echo $categorie['id'] ?>" onclick="return confirm('Do you want to delete category <?php echo $categorie['name'] ?>');" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            
            <?php
        }
        ?>

            </tbody>
        </table>
    </div>

</body>
</html>
