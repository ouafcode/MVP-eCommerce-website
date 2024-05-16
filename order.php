<?php
require_once 'include/database.php';
$idCommande = $_GET['id'];
$sqlState = $pdo->prepare('SELECT commande.*,user.login as "login" FROM commande 
            INNER JOIN user ON commande.id_client = user.id 
                                               WHERE commande.id = ?
                                               ORDER BY commande.date_creation DESC');
$sqlState->execute([$idCommande]);
$commande = $sqlState->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Order | Number <?= $commande['id'] ?></title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container" py-2>    
    <h2>Orders details</h2>

       <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sqlStateLigneCommandes = $pdo->prepare('SELECT ligne_commande.*,produit.name,produit.image from ligne_commande
                                                            INNER JOIN produit ON ligne_commande.id_product = produit.id
                                                            WHERE id_command = ?
                                                            ');
            $sqlStateLigneCommandes->execute([$idCommande]);
            $lignesCommandes = $sqlStateLigneCommandes->fetchAll(PDO::FETCH_OBJ);
            ?>
            <tr>
                <td><?php echo $commande['id'] ?></td>
                <td><?php echo $commande['login'] ?></td>
                <td><?php echo $commande['total'] ?> MAD</td>
                <td><?php echo $commande['date_creation'] ?></td>
                <td>
                <?php if ($commande['valide'] == 0) : ?>
                    <a class="btn btn-success btn-sm" href="validate_order.php?id=<?= $commande['id']?>&etat=1">validate order</a>
                <?php else: ?>
                    <a class="btn btn-danger btn-sm" href="validate_order.php?id=<?= $commande['id']?>&etat=0">Cancel order</a>
                <?php endif; ?>
                </td>
                <td>
                </td>
            </tr>
            <?php
            ?>
            </tbody>
        </table>
        <hr>
        <h2>Products : </h2>
        <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#ID</th>
            <th>Product</th>
            <th>Unit price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($lignesCommandes as $lignesCommande) : ?>
            <tr>
                <td><?php echo $lignesCommande->id ?></td>
                <td><?php echo $lignesCommande->name ?></td>
                <td><?php echo $lignesCommande->prix ?> MAD</td>
                <td>x <?php echo $lignesCommande->quantite ?></td>
                <td><?php echo $lignesCommande->Total ?> MAD</td>
            </tr>
        <?php endforeach; ?>
        </tbody>           
    </table>
    </div>
</body>
</html>
