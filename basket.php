<?php include 'header.php'; ?>

<?php foreach ($_SESSION['basket'] as $item): ?>
    <?php
    $productSql = $db->prepare('SELECT * FROM products WHERE id = ? LIMIT 1');
    $productSql->execute([$item]);
    $product = $productSql->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <div class="basket">

            <div class="basket-item mt-5">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-3">
                        <div class="basket-img">
                            <img src="<?php echo $product['photo'] ?>">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-9">
                        <h6><?php echo $product['title'] ?></h6>
                        <span class="text-muted text-decoration-line-through me-2"><?php echo $product['price'] . 'TL' ?></span>
                        <span class="fs-4"><?php echo $product['discount_price'] . 'TL' ?></span>
                        <a class="btn btn-sm btn-danger" href="delete-basket.php?productId=<?php echo $product['id'] ?>">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php endforeach; ?>





<?php include 'footer.php'; ?>
