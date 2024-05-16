<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Sign in</title>
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
                        login, password  are mandatory
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