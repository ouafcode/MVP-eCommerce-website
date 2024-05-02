<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edit product</title>
</head>
<body>
<?php
require_once 'include/database.php';
include 'include/nav.php' ?>
<div class="container py-2">
    <h4>Edit product</h4>
    <?php
    $id = $_GET['id'];
    $sqlState = $pdo->prepare('SELECT * from produit WHERE id=?');
    $sqlState->execute([$id]);
    $product = $sqlState->fetch(PDO::FETCH_OBJ);;
    if (isset($_POST['Edit'])) {
        $name = $_POST['name'];
        $prix = $_POST['prix'];
        $discount = $_POST['discount'];
        $categorie = $_POST['categorie'];



        if (!empty($name) && !empty($prix) && !empty($categorie)) {
                $query = "UPDATE produit
                                        SET name=? ,
                                            prix=? ,
                                            discount=? ,
                                            id_categorie=?
                                    WHERE id = ? ";
                $sqlState = $pdo->prepare($query);
                $updated = $sqlState->execute([$name, $prix, $discount, $categorie, $id]);
            if ($updated) {
                header('location: product.php');
            } else {

                ?>
                <div class="alert alert-danger" role="alert">
                    Database error (40023).
                </div>
                <?php
            }
            } else {
            ?>
            <div class="alert alert-danger" role="alert">
                name, price, are mandatory
            </div>
            <?php
        }

    }
    ?>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product->id ?>">
        <label class="form-label">name</label>
        <input type="text" class="form-control" name="name" value="<?= $product->name ?>">

        <label class="form-label">Price</label>
        <input type="number" class="form-control" step="0.1" name="prix" min="0" value="<?= $product->prix ?>">

        <label class="form-label">Discount</label>
        <input type="range" value="0" class="form-control" name="discount" min="0" max="90"
               value="<?= $product->discount ?>">

        
        <?php

        ?>

        <?php
        $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <label class="form-label">Categorie</label>
        <select name="categorie" class="form-control">
            <option value="">choose category</option>
            <?php
            foreach ($categories as $categorie) {
                $selected = $product->id_categorie == $categorie['id'] ? ' selected ' : '';
                echo "<option $selected value='" . $categorie['id'] . "'>" . $categorie['name'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Edit product" class="btn btn-primary my-2" name="Edit">
    </form>
</div>
</body>
</html>