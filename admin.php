<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Admin</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container" py-2>
        <?php
            if(!isset($_SESSION['utilisateur'])){
                header( header: 'location: connexion.php');
            }
        ?>
        <h3> Welcome, <?php echo ($_SESSION['utilisateur']['login']); ?></h3>
    </div>

</body>
</html>
