<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Ecommerce</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">category list</a>
        </li>

      </ul>
      
    </div>
    <?php
              $productCount = 0;
              if (isset($_SESSION['utilisateur'])) {
                  $idUtilisateur = $_SESSION['utilisateur']['id'];
                  $productCount = count($_SESSION['panier'][$idUtilisateur] ?? []);
              }
              function calculerRemise($prix, $discount)
              {
                  return $prix - (($prix * $discount) / 100);
              }
    
              
    ?>
            <a class="btn float-end" href="../"><i
                    class="fa-solid fa-screwdriver-wrench"></i> Backoffice</a>
            <a class="btn float-end" href="cart.php"><i class="fa-solid fa-cart-shopping"></i> Shopping cart
            (<?php echo $productCount; ?>)</a>
  </div>
</nav> 