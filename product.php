<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>list product</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container" py-2>    
    <h2>List of product</h2>
    <a href="add_product.php" class="btn btn-primary">Add product</a>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Final price</th> 
                    <th>Category</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require_once 'include/database.php';
            $products = $pdo->query("SELECT produit.*,categorie.name as 'categorie_name' FROM produit INNER JOIN categorie ON produit.id_categorie = categorie.id")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($products as $product){
                $prix = $product['prix'];
                $discount = $product['discount'];
                $prixFinale = $prix - (($prix*$discount)/100);
            ?>
            <tr>
                <td><?php echo $product['id'] ?></td>
                <td><?php echo $product['name'] ?></td>
                <td><?php echo $prix ?>MAD</td>
                <td><?php echo $discount ?>%</td>
                <td><?php echo $prixFinale ?>MAD</td>

                <td><?php echo $product['categorie_name'] ?></td>
                <td><img class="img-fluid" width="90" src="upload/product/<?= $product['image'] ?>" alt="<?= $product['name'] ?>"></td>
                <td><?php echo $product['date_creation'] ?></td>
                <td>
                    <a class="btn btn-primary" href="Edit_product.php?id=<?php echo $product['id'] ?>">Edit</a>
                    <a href="Delete_product.php?id=<?php echo $product['id'] ?>" onclick="return confirm('Do you want to delete this product <?php echo $product['name'] ?>');" class="btn btn-danger">Delete</a>
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
