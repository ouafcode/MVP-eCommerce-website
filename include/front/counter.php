<div>
    <?php
            $idUtilisateur = $_SESSION['utilisateur']['id'] ?? 0;
            $qty = $_SESSION['panier'][$idUtilisateur][$idProduct] ?? 0;
            if ($qty == 0) {
                $color = 'btn-primary';
                $button = '<i class="fa fa-light fa-cart-plus"></i>';
            } else {
                $button = '<i class="fa-solid fa-pencil"></i>';
            }
    ?>
    <form method="post" class="counter d-flex" action="add_cart.php">
        <button onclick="return false;" class="btn btn-primary mx-2 counter-moins">-</button>
        <input type="hidden" name="id" value="<?php echo $idProduct ?>">
        <input class="form-control" value="<?php echo $qty ?>" type="number" name="qty" id="qty" max="99">
        <button onclick="return false;" class="btn btn-primary mx-2 counter-plus">+</button>
        

        <button class="btn btn-success btn-sm" type="submit" name="ajouter">
                <?= $button ?>
        </button>
        <?php
            if($qty != 0){
                ?>
                     <button formaction="delete_cart.php" class="btn btn-sm btn-danger mx-1" type="submit" value="Delete" name="delete">
                       <i class="fa-solid fa-trash"></i> 
                <?php
            }
        ?>
    </form>
</div>