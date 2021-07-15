<?php include 'header.php'; ?>
<?php

if (isset($_GET['favorited'])) {
    $checkFavoritesSql = $db->prepare('SELECT p.* FROM favorites AS f
INNER JOIN products AS p ON (f.product_id = p.id AND f.user_id = ?)');
    $checkFavoritesSql->execute([$_SESSION['id']]);
    $products = $checkFavoritesSql->fetchAll(PDO::FETCH_ASSOC);
} else if (isset($_GET['category_id'])) {
    $categoryId = strip_tags($_GET['category_id']);
    $checkCategorySql = $db->prepare('SELECT * FROM products WHERE category_id = ?');
    $checkCategorySql->execute([$categoryId]);

    $products = $checkCategorySql->fetchAll(PDO::FETCH_ASSOC);

} else {
    $productsSql = $db->query('SELECT * FROM products');
    $products = $productsSql->fetchAll(PDO::FETCH_ASSOC);
}

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
    header('location:login.php');
}

?>
<div class="container">
    <div class="products">
        <div class="row">
            <?php foreach ($products as $product): ?>
                <?php $favoritesSql = $db->prepare('SELECT * FROM favorites WHERE product_id = ? AND user_id = ?');
                $favoritesSql->execute([$product['id'], $_SESSION['id']]);
                $isFavorited = $favoritesSql->rowCount() == 1;
                ?>
                <div class="col-sm-12 col-md-12 col-lg-3">

                    <div class="product-item mb-5">
                        <div class="product-photo">
                            <img class="img-fluid" src="<?php echo $product['photo'] ?>">

                            <div class="fav-icon">
                                <?php if ($isFavorited) : ?>
                                    <a href="favorited.php?product_id=<?php echo $product['id'] ?>">
                                        <i class="fas fa-heart isFavorited"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="favorited.php?product_id=<?php echo $product['id'] ?>">
                                        <i class="far fa-heart"></i>
                                    </a>
                                <?php endif; ?>
                            </div>

                        </div>
                        <div class="product-title mt-4">
                            <a href="product-detail.php?product_id=<?php echo $product['id'] ?>">
                                <h6><?php echo $product['title'] ?></h6></a>
                        </div>
                        <div class="product-price">
                            <?php if ($product['discount'] == false) : ?>
                                <span class="price fs-4"><?php echo $product['price'] . 'TL' ?> </span>
                            <?php else : ?>
                                <span class="price text-decoration-line-through text-muted me-2"><?php echo $product['price'] . 'TL' ?> </span>
                                <span class="discount-price fs-4"><?php echo $product['discount_price'] . 'TL' ?> </span>
                            <?php endif; ?>
                        </div>

                        <a href="add-basket.php?productId=<?php echo $product['id'] ?>" class="btn btn-success">SEPETE EKLE</a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </div>
</div>


<?php include 'footer.php'; ?>
