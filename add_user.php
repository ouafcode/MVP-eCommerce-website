<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Add user</title>
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
        <form method="post" autocomplete="off">
            <label class="form-label">Login</label>
            <input type="password"  class="form-control"  name="login">

            <label class="form-label">Password</label>
            <input type="password"  class="form-control"  name="password">
    
            <input type="submit" value="Add user" class="btn btn-primary my-2" name="add">
        </form>
    </div>

</body>
</html>
