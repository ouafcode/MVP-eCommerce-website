<?php
  session_start();
  $connecte = false;
  if (isset($_SESSION['utilisateur'])){
    $connecte = true;
  }
?>
 
 
 <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">eCommerce</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">add user</a>
        </li>
        <?php 
          if($connecte){
            ?>
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="category.php">list categorie</a>
                </li>                
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="product.php">list product</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="add_category.php">add categorie</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="add_product.php">add product</a>
                </li>                
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="deconnexion.php">deconnexion</a>
                </li>

            <?php
          }else{
              ?>
              
                <li class="nav-item">
                   <a class="nav-link" href="connexion.php">Connexion</a>
                </li>
              <?php 
          }                                                                                                    
        ?>

      </ul>
    </div>
  </div>
</nav> 