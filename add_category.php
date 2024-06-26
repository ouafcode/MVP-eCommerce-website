<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Add category</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container" py-2>
        <h4>Add categorie</h4>
        <?php
            if (isset($_POST['add'])){
                $name= $_POST['name'];
                $description = $_POST['description'];
                $icon = $_POST['icon'];

                if (!empty($name) && !empty($description)){
                    require_once 'include/database.php';
                    $sqlState = $pdo->prepare( query: 'INSERT INTO categorie(name,description,icon) VALUES(?,?,?)');
                    $sqlState->execute([$name,$description,$icon]);
                    header( header: 'location: category.php');
                    ?>
                        <div class="alert alert-success" role="alert">
                            category <?php echo $name ?> added
                        </div>
                    <?php
                }else{
                    ?>
                        <div class="alert alert-danger" role="alert">
                            Name, description ,icon are missing
                        </div>
                    <?php
                }
            }
        ?>
        <form method="post">
            <label class="form-label">Name</label>
            <input type="password"  class="form-control"  name="name">

            <label class="form-label">Description</label>
            <textarea class="form-control" name="description"></textarea>

            <label class="form-label">Icons</label>
            <textarea class="form-control" name="icon"></textarea>
            
            <input type="submit" value="Add category" class="btn btn-primary my-2" name="add">
        </form>
    </div>

</body>
</html>
