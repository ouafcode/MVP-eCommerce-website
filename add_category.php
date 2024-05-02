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
        <h4>Add categorie</h4>
        <?php
            if (isset($_POST['add'])){
                $name= $_POST['name'];
                $description = $_POST['description'];

                if (!empty($name) && !empty($description)){
                    require_once 'include/database.php';
                    $sqlState = $pdo->prepare( query: 'INSERT INTO categorie(name,description) VALUES(?,?)');
                    $sqlState->execute([$name,$description]);
                    header( header: 'location: category.php');
                    ?>
                        <div class="alert alert-success" role="alert">
                            category <?php echo $name ?> added
                        </div>
                    <?php
                }else{
                    ?>
                        <div class="alert alert-danger" role="alert">
                            Name, description are missing
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
            
            <input type="submit" value="Add category" class="btn btn-primary my-2" name="add">
        </form>
    </div>

</body>
</html>
