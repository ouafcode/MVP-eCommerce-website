<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
