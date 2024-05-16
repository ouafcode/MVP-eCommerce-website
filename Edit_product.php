<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
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
        $description = $_POST['description'];


        $filename = '';
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $filename = uniqid() . $image;
            move_uploaded_file($_FILES['image']['tmp_name'], 'upload/product/' . $filename);
        }

        if (!empty($name) && !empty($prix) && !empty($categorie)) {
            if (!empty($filename)) {
                $query = "UPDATE produit
                                        SET name=? ,
                                            prix=? ,
                                            discount=? ,
                                            id_categorie=?,
                                            description=?,
                                            image=?
                                    WHERE id = ? ";
                $sqlState = $pdo->prepare($query);
                $updated = $sqlState->execute([$name, $prix, $discount, $categorie, $description, $filename, $id]);
            } else{
                $query = "UPDATE produit 
                                        SET name=? ,
                                        prix=? ,
                                        discount=? ,
                                        id_categorie=?,
                                        description=?
                                    WHERE id = ? ";
                $sqlState = $pdo->prepare($query);
                $updated = $sqlState->execute([$name, $prix, $discount, $categorie, $description, $id]);
            }
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
        
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description"><?= $product->description ?></textarea>

        <label class="form-label">Image</label>
        <input type="file" class="form-control" name="image" >
        <img width="250" class="img img-fluid" src="upload/product/<?= $product->image ?>"><br>
        
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