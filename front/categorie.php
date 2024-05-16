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
    <?php include '../include/head_front.php' ?>
    <title>Categorie | <?php echo $categorie['name'] ?></title>
</head>
<body>
<?php include '../include/nav_front.php' ?>
<div class="container py-2">
    <h4><?php echo $categorie['name'] ?> <i class="fa <?php echo $categorie['icon']?>"></i></h4>
    <div class="container">
        <div class="row">
            <?php require_once '../include/front/product/show_product.php'; ?>
        </div>

    </div>
</div>
</body>
</html>