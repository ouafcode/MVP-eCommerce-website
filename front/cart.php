<?php
session_start();
require_once '../include/database.php';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <?php include '../include/head_front.php' ?>
    <title>Shopping Cart</title>
</head>
<body>
<?php include '../include/nav_front.php' ?>
<div class="container py-2">
    
    <?php           
        if(isset($_POST['vider'])){
            $_SESSION['panier'][$idUtilisateur] = [];
            header( 'location: cart.php');
        }

        $idUtilisateur = $_SESSION['utilisateur']['id'] ?? 0;
        $cart = $_SESSION['panier'][$idUtilisateur] ?? [];

        if(!empty($cart)){
            $idProducts = array_keys($cart);
            $idProducts = implode(',', $idProducts);
            $products = $pdo->query("SELECT * FROM produit WHERE id IN ($idProducts)")->fetchAll(PDO::FETCH_ASSOC);
        }

        if(isset($_POST['valider'])){
            $sql = 'INSERT INTO ligne_commande(id_product,id_command,prix,quantite,Total) VALUES';
            $total = 0;
            $prixProducts = [];

            foreach ($products as $product) {
                $idProduct = $product['id'];
                $qty = $cart[$idProduct];
                $discount = $product['discount'];
                $prix = calculerRemise($produit['prix'], $discount);
                $total += $qty * $prix;
                $prixProducts[$idProduct] = [
                    'id' => $idProduct,
                    'prix' => $prix,
                    'total' => $qty * $prix,
                    'qty' => $qty
                ];
        }

        $sqlStateCommande = $pdo->prepare('INSERT INTO commande(id_client,total) VALUES(?,?)');
        $sqlStateCommande->execute([$idUtilisateur, $total]);
        $idCommande = $pdo->lastInsertId();

        //$args = [];
        foreach ($prixProducts as $product) {
            $id = $product['id'];
            $sql .= "(:id$id,'$idCommande',:prix$id,:qty$id,:total$id),";
        }
        $sql = substr($sql, 0, -1);
        $sqlState = $pdo->prepare($sql);
        foreach ($prixProducts as $product) {
            $id = $product['id'];
            $sqlState->bindParam(':id' . $id, $product['id']);
            $sqlState->bindParam(':prix' . $id, $product['prix']);
            $sqlState->bindParam(':qty' . $id, $product['qty']);
            $sqlState->bindParam(':total' . $id, $product['total']);
        }
        $inserted = $sqlState->execute();
        if ($inserted) {

            $_SESSION['panier'][$idUtilisateur] = [];
            header('location: cart.php?success=true&total=' . $total);
        } else {
            ?>
            <div class="alert alert-error" role="alert">
                Error (contact administrator).
            </div>
            <?php
        }
    }
    if (isset($_GET['success'])) {
        ?>
        <h1>Thanks ! </h1>
        <div class="alert alert-success" role="alert">
            Your order with the amount <strong>(<?php echo $_GET['total'] ?? 0 ?>)</strong> <i class="fa fa-solid fa-dollar"></i> is added.
        </div>
        <hr>
        <?php
    }

    ?>
                     
    <h4>Shopping Cart (<?php echo $productCount; ?>)</h4> 
    <div class="container">
        <div class="row">
            <?php
            if (empty($cart)){
                ?>
                <div class="alert alert-warning" role="alert">
                    your cart is empty
                </div>
                <?php
            }else{
                $idProducts = array_keys($cart);
                $idProducts = implode(',', $idProducts);
                $products = $pdo->query("SELECT * FROM produit WHERE id IN ($idProducts)")->fetchAll(PDO::FETCH_ASSOC);
                ?>
   
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Discount</th>
                        <th scope="col"><i class="fa fa-percent"></i> Discount price</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <?php
                    $total = 0;
                    foreach ($products as $product) {
                        $idProduct = $product['id'];
                        $Totalproduct = calculerRemise($product['prix'], $product['discount']) * $cart[$idProduct];
                        $total+= $Totalproduct;
                        ?>
                        <tr>
                            <td><?php echo $product['id'] ?></td>
                            <td><img width="80px" src="../upload/product/<?php echo $product['image'] ?>" alt=""></td>
                            <td><?php echo $product['name'] ?></td>
                            <td><?php include '../include/front/counter.php' ?></td>
                            <td><?php echo $product['prix'] ?> MAD</td>
                            <td> - <?= $product['discount'] ?> %</td>
                            <td><?php echo calculerRemise($product['prix'], $product['discount']) ?> MAD</td>
                            <td><?php echo $Totalproduct ?> MAD</td>
                        </tr>
   
                        <?php
                    }






                ?>
                <tfoot>
                    <tr>
                        <td colspan="7" align="right"><strong>Total</strong></td>
                        <td><?php echo $total ?> MAD</td>
                    </tr>
                    <tr>
                        <td colspan="8" align="right">
                            <form method="post">
                                <input type="submit" class="btn btn-success" name="valider" value="Validate the order">
                                <input onclick="return confirm('Are you sure you want to empty the cart?')" type="submit"
                                       class="btn btn-danger" name="vider" value="clear the order">
                            </form>
                        </td>
                    </tr>
                </tfoot>
                </table>
                <?php
        }
        ?>           
        </div>
    </div>
</div>

</body>
</html>