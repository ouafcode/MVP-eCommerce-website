<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
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
        $icon = $_POST['icon'];


        if (!empty($name) && !empty($description)) {
            $sqlState = $pdo->prepare('UPDATE categorie
                                                SET name = ? ,
                                                    description = ?,
                                                    icon = ?
                                        WHERE id = ?
                                            ');
            $sqlState->execute([$name, $description, $icon, $id]);
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

        <label class="form-label">Icon</label>
        <textarea class="form-control" name="icon"><?php echo $category['icon'] ?></textarea>


        <input type="submit" value="Edit catégorie" class="btn btn-primary my-2" name="Edit">
    </form>
</div>

</body>
</html>