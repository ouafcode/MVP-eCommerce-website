<?php
session_start();
require_once '../include/database.php';
$id = $_GET['id'];
$sqlState = $pdo->prepare("SELECT * FROM categorie WHERE id=?");
$sqlState->execute([$id]);
$categorie = $sqlState->fetch(PDO::FETCH_ASSOC);

$sqlState = $pdo->prepare("SELECT * FROM produit WHERE id_categorie=?");
$sqlState->execute([$id]);
$products = $sqlState->fetchAll(PDO::FETCH_OBJ);

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Categorie | <?php echo $categorie['name'] ?></title>
</head>
<body>
<?php include '../include/nav_front.php' ?>
<div class="container py-2">
    <h4><?php echo $categorie['name'] ?></h4>
    <div class="container">
        <div class="row">
            <?php
                foreach ($products as $product){
                    ?>
                    <div class="card mb-3 col-md-4">
                        <img class="card-img-top" src=".." alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product->name ?></h5>
                            <p class="card-text"><?php echo $product->prix ?> MAD</p>
                            <p class="card-text"><small class="text-muted">Added at 
                                : <?= date_format(date_create($product->date_creation), 'Y/m/d') ?></small></p>
                        </div>
                    </div>

                    <?php
                }
            ?>
        </div>
    </div>
</div>
</body>
</html>