<?php
  session_start();
  $connecte = false;
  if (isset($_SESSION['utilisateur'])){
    $connecte = true;
  }
?>
 
 
 <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Ecommerce</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php
        $currentPage = $_SERVER['PHP_SELF'];
    ?>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link <?php if ($currentPage == '/ECOMMERCE/index.php') echo 'active' ?>"
                       aria-current="page" href="index.php"><i class="fa-solid fa-home"></i> Home</a>
        </li>
        <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == '/ECOMMERCE/add_user.php') echo 'active' ?>"
                       aria-current="page" href="add_user.php"><i class="fa-solid fa-user-plus"></i>
                        Add user</a>
        </li>
        <?php 
          if($connecte){
            ?>
               <li class="nav-item">
                  <a class="nav-link <?php if ($currentPage == '/ECOMMERCE/category.php') echo 'active' ?>"
                        aria-current="page" href="category.php"><i
                                  class="fa-brands fa-dropbox"></i> category list </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == '/ECOMMERCE/product.php') echo 'active' ?>"
                          aria-current="page" href="product.php"><i class="fa-solid fa-tag"></i>
                            product list</a>
                </li>



                <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == '/ECOMMERCE/orders.php') echo 'active' ?>"
                           aria-current="page" href="orders.php"><i
                                    class="fa-solid fa-barcode"></i> Orders</a>
                </li>

                <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="deconnexion.php"><i
                                    class="fa-solid fa-right-from-bracket"></i> Sign out</a>
                </li>

            <?php
          }else{
              ?>
              
              <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == '/ECOMMERCE/connexion.php') echo 'active' ?>"
                           href="connexion.php"><i class="fa-solid fa-arrow-right-to-bracket"></i> Sign in</a>
              </li>
              <?php 
          }                                                                                                    
        ?>

      </ul>
    </div>
    <a class="btn float-end" href="front/"><i class="fa-solid fa-cart-shopping"></i> Site front</a>
  </div>
</nav> 