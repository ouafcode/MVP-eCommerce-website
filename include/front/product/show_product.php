<?php
foreach ($products as $product) {
    $idProduct = $product->id;
    ?>
    <div class="col-md-6 mb-4">
        <div class="card h-100">

            <?php if (!empty($product->discount)): ?>
                <span class="badge rounded-pill text-bg-warning w-25 position-absolute m-2" style="right:0"> - <?= $product->discount ?> <i
                            class="fa fa-percent"></i></span>
            <?php endif; ?>

            <img class="card-img-top w-75    mx-auto" src="../upload/product/<?= $product->image ?>"
                 alt="Card image cap">
            <div class="card-body">
                <a href="produit.php?id=<?php echo $idProduct ?>" class="btn stretched-link"></a>
                <h5 class="card-title"><?= $product->name ?></h5>
                <p class="card-text"><?= $product->description ?></p>
                <p class="card-text"><small class="text-muted">Ajouté le
                        : <?= date_format(date_create($product->date_creation), 'Y/m/d') ?></small></p>
            </div>
            <div class="card-footer bg-white" style="z-index: 10">
                <?php if (!empty($product->discount)): ?>
                    <div class="h5"><span
                                class="badge rounded-pill text-bg-danger"><strike> <?= $product->prix ?></strike> <i
                                    class="fa fa-solid fa-dollar"></i></span></div>
                    <div class="h5"><span
                                class="badge rounded-pill text-bg-success">Sales : <?= calculerRemise($product->prix, $product->discount) ?> <i
                                    class="fa fa-solid fa-dollar"></i></span></div>
                <?php else: ?>
                    <div class="h5"><span class="badge rounded-pill text-bg-success"><?= $product->prix ?> <i
                                    class="fa fa-solid fa-dollar"></i></span></div>

                <?php endif; ?>


                <?php include '../include/front/counter.php' ?>
            </div>
        </div>
    </div>
    <?php
}
if (empty($products)) {
    ?>
    <div class="alert alert-info" role="alert">
        No Product for the moment.
    </div>

    <?php
}
?>