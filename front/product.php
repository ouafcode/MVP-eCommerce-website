<?php
session_start();
require_once '../include/database.php';
$id = $_GET['id'];
$sqlState = $pdo->prepare("SELECT * FROM produit WHERE id=?");
$sqlState->execute([$id]);
$product = $sqlState->fetch(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <?php include '../include/head_front.php' ?>
    <title>product | <?php echo $product['name'] ?></title>
</head>
<body>
<?php include '../include/nav_front.php' ?>
<div class="container py-2">
    <h4><?php echo $product['name'] ?></h4>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img class="img img-fluid w-75" src="../upload/product/<?php echo $product['image'] ?>"
                     alt="<?php echo $product['name'] ?>">
            </div>

            <div class="col-md-6">
                <?php
                    $discount = $product['discount'];
                    $prix = $product['prix'];
                ?>
                <div class="d-flex align-items-center">
                    <h1 class="w-100"><?php echo $product['name'] ?></h1>
                    <?php if (!empty($discount)) {
                        ?>
                        <span class="badge text-bg-success">- <?php echo $discount ?> %</span>
                        <?php
                    } ?>
                </div>
                <hr>

                
                <p class="text-justify">
                    <?php echo $product['description'] ?>
                </p>
                <hr>

                <div class="d-flex">
                    <?php
                    if (!empty($discount)) {
                        $total = $prix - (($prix * $discount) / 100);
                        ?>
                        <h5 class="mx-1">
                            <span class="badge text-bg-danger"><strike> <?php echo $prix ?> <i class="fa fa-solid fa-dollar"></i> </strike></span>
                        </h5>
                        <h5 class="mx-1">
                            <span class="badge text-bg-success"><?php echo $total ?> <i class="fa fa-solid fa-dollar"></i></span>
                        </h5>

                        <?php
                    } else {
                        $total = $prix;
                        ?>
                        <h5>
                            <span class="badge text-bg-success"><?php echo $total ?> <i class="fa fa-solid fa-dollar"></i></span>
                        </h5>

                        <?php
                    }
                    ?>
                    

                </div>
                <hr>

                <?php 
                $idProduct = $product['id'];
                include '../include/front/counter.php'?>
                <hr>

            </div>
        </div>
    </div>
</div>


</body>
</html>