<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php include '../include/nav_front.php' ?>
    <div class="container py-2">
        <h4>list of category</h4>
    <?php
    require_once '../include/database.php';
    $categoryId = $_GET['id'] ?? NULL;
    $categories = $pdo->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_OBJ);
    ?>

    <ul class="list-group list-group-flush w-25">
        <?php
            foreach ($categories as $categorie) {
                ?>
                <li class="list-group-item">
                    <a class="btn btn-light0" href="categorie.php?id=<?php echo $categorie->id ?>">
                    <?php echo $categorie->name ?>
                    </a>
                </li>
                <?php
            }
        ?>
    </ul>
    </div>

</body>
</html>
