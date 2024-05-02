<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Add product</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container" py-2>
        <h4>Add product</h4>
        <?php
                if (isset($_POST['add'])) {
                    $name = $_POST['name'];
                    $prix = $_POST['prix'];
                    $discount = $_POST['discount'];
                    $categorie = $_POST['categorie'];
                    $date = date(format: 'Y-m-d');

                    if (!empty($name) && !empty($prix) && !empty($categorie)) {
                        require_once 'include/database.php';
                        $sqlState = $pdo->prepare('INSERT INTO produit VALUES (null,?,?,?,?,?)');
                        $inserted = $sqlState->execute([$name, $prix, $discount, $categorie,$date]);
                        if ($inserted) {
                            header(header: 'location: product.php');
                        } else {
            
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Database error (40023).
                            </div>
                            <?php
                        }

                    } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            name , prix , categorie are missed.
                        </div>
                        <?php
                    }
                }
        ?>
        <form method="post">
            <label class="form-label">Name</label>
            <input type="password"  class="form-control"  name="name">

            <label class="form-label">Prix</label>
            <input type="number" class="form-control" step="0.1" name="prix" min="0">
            
            <label class="form-label">Discount</label>
            <input type="number" value="0" class="form-control" name="discount" min="0" max="50">


            <?php
                require_once 'include/database.php';
                $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <label class="form-label">category</label>
            <select name="categorie" class="form-control">
                <option value="">Choose category</option>
                <?php
                    foreach ($categories as $categorie) {
                    echo "<option value='" . $categorie['id'] . "'>" . $categorie['name'] . "</option>";
                 }
                ?>
            </select>

            <input type="submit" value="Add product" class="btn btn-primary my-2" name="add">
        </form>
    </div>

</body>
</html>
