<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
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
                    <th>Icons</th>
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
                <td>
                    <i class="fa <?php echo $categorie['icon'] ?>"></i>
                </td>
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
