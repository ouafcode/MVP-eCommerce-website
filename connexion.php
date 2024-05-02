<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>connexion</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container" py-2>
        <?php
            if(isset($_POST['connexion'])){
                $login = $_POST['login'];
                $pass = $_POST['password'];

                if(!empty($login) && !empty($pass)){
                    require_once 'include/database.php';
                    $sqlState = $pdo->prepare( query: 'SELECT * FROM user WHERE login=? AND password=?');
                    $sqlState->execute([$login, $pass]);
                    if($sqlState->rowCount()>=1){
                        $_SESSION['utilisateur'] = $sqlState->fetch();
                        header( header: 'location: admin.php');
                    }else{
                        ?>
                        <div class="alert alert-danger role="alert">
                            login, password  incorrect
                        </div>
                        <?php
                    }
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
    
            <input type="submit" value="Connexion" class="btn btn-primary my-2" name="connexion">
        </form>
    </div>

</body>
</html>