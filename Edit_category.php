<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">   
    <title>Edit Category</title>
    
</head>
<body>
<?php include 'include/nav.php' ?>
<div class="container py-2">
    <h4>Edit category</h4>
    <?php
    require_once 'include/database.php';
    $sqlState = $pdo->prepare('SELECT * FROM categorie WHERE id=?');
    $id = $_GET['id'];
    $sqlState->execute([$id]);

    $category = $sqlState->fetch(PDO::FETCH_ASSOC);
    if (isset($_POST['Edit'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];


        if (!empty($name) && !empty($description)) {
            $sqlState = $pdo->prepare('UPDATE categorie
                                                SET name = ? ,
                                                    description = ?
                                        WHERE id = ?
                                            ');
            $sqlState->execute([$name, $description, $id]);
            header(header: 'location: category.php');
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                name, description are mandatory
            </div>
            <?php
        }

    }

    ?>
    <form method="post">
        <input type="hidden" class="form-control" name="id" value="<?php echo $category['id'] ?>">
        <label class="form-label">name</label>
        <input type="text" class="form-control" name="name" value="<?php echo $category['name'] ?>">

        <label class="form-label">Description</label>
        <textarea class="form-control" name="description"><?php echo $category['description'] ?></textarea>


        <input type="submit" value="Edit catégorie" class="btn btn-primary my-2" name="Edit">
    </form>
</div>

</body>
</html>