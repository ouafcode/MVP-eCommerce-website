<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container" py-2>
        <h4>Add user</h4>
        <?php
            if(isset($_POST['add'])){
                $login = $_POST['login'];
                $pass = $_POST['password'];

                if(!empty($login) && !empty($pass)){
                    // to connect database
                    require_once 'include/database.php';
                    $date = date( format: 'Y-m-d');
                    $sqlState = $pdo->prepare( query: 'INSERT INTO user VALUES(null,?,?,?)');
                    $sqlState->execute([$login,$pass,$date]);

                    //Redirection
                    header( header: 'location: connexion.php');
                }else{
                    ?>
                    <div class="alert alert-danger role="alert">
                        login, password  missed
                    </div>
                    <?php
                }
            }
        ?>
        <form method="post">
            <label class="form-label">Login</label>
            <input type="password"  class="form-control"  name="login">

            <label class="form-label">Password</label>
            <input type="password"  class="form-control"  name="password">
    
            <input type="submit" value="Add user" class="btn btn-primary my-2" name="add">
        </form>
    </div>

</body>
</html>
