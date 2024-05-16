<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
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
                    $description = $_POST['description'];
                    $date = date(format: 'Y-m-d');

                    $filename= "eBee-X-icon3.png";
                    if (!empty($_FILES['image']['name'])){
                        $image = $_FILES['image']['name'];
                        $filename = uniqid() . $image; 
                        move_uploaded_file($_FILES['image']['tmp_name'], 'upload/product/'.$filename);
                    }

                    if (!empty($name) && !empty($prix) && !empty($categorie)) {
                        require_once 'include/database.php';
                        $sqlState = $pdo->prepare('INSERT INTO produit VALUES (null,?,?,?,?,?,?,?)');
                        $inserted = $sqlState->execute([$name, $prix, $discount, $categorie,$description,$filename,$date]);
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
        <form method="post" enctype="multipart/form-data">
            <label class="form-label">Name</label>
            <input type="password"  class="form-control"  name="name">

            <label class="form-label">Prix</label>
            <input type="number" class="form-control" step="0.1" name="prix" min="0">
            
            <label class="form-label">Discount</label>
            <input type="number" value="0" class="form-control" name="discount" min="0" max="50">

            <label class="form-label">Description</label>
            <textarea class="form-control" name="description"></textarea>

            <label class="form-label">Image</label>
            <input type="file"  class="form-control" name="image">

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
