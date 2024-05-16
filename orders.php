<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>list of order</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container" py-2>    
    <h2>List of order</h2>

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
            require_once 'include/database.php';
            $commandes = $pdo->query('SELECT commande.*,user.login as "login" FROM commande INNER JOIN user on commande.id_client = user.id ORDER BY commande.date_creation DESC')->fetchAll(PDO::FETCH_ASSOC);
            foreach ($commandes as $commande){
            ?>
            <tr>
                <td><?php echo $commande['id'] ?></td>
                <td><?php echo $commande['login'] ?></td>
                <td><?php echo $commande['total'] ?> MAD</td>
                <td><?php echo $commande['date_creation'] ?></td>
                <td><a class="btn btn-primary btn-sm" href="order.php?id=<?php echo $commande['id']?>">Show details</a></td>
            </tr>
            
            <?php
        }
        ?>

            </tbody>
        </table>
    </div>

</body>
</html>
