<?php include 'header.php'; ?>

<?php
$product_id = strip_tags($_GET['product_id']);
$productsSql = $db->prepare('SELECT * FROM products WHERE id = ?');
$productsSql->execute([$product_id]);
$products = $productsSql->fetch(PDO::FETCH_ASSOC);

$commentSql = $db->prepare('SELECT * FROM comments WHERE product_id = ?');
$commentSql->execute([$products['id']]);
$comments = $commentSql->fetchAll(PDO::FETCH_ASSOC);


?>

    <div class="container">
        <div class="product-details">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-5">
                    <div class="detail-image">
                        <img src="<?php echo $products['photo'] ?>">
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-7">
                    <div class="detail">
                        <div class="product-title">
                            <h5><?php echo $products['title'] ?></h5>
                        </div>
                        <div class="product-price mt-5">
                            <?php if ($products['discount'] == false) : ?>
                                <span class="price fs-4"><?php echo $products['price'] . 'TL' ?> </span>
                            <?php else : ?>
                                <span class="price text-decoration-line-through text-muted me-2"><?php echo $products['price'] . 'TL' ?> </span>
                                <span class="discount-price fs-4"><?php echo $products['discount_price'] . 'TL' ?> </span>
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <p> <?php echo $products['description'] ?> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="new-comment mt-5">
            <h6>NEW COMMENT</h6>
            <form method="post" action="new-comment.php">
                <textarea rows="4" name="content"></textarea>
                <input type="hidden" name="product_id" value="<?php echo $products['id'] ?>">
                <div class="action">
                    <select name="rating">
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                    <button type="submit" class="btn"><i class="fas fa-location-arrow"></i></button>
                </div>

            </form>
        </div>

        <div class="comments mt-5">
            <h4 class="mb-3">ÜRÜN DEĞERLENDİRMELERİ</h4>
            <?php if (count($comments) > 0): ?>

                <?php foreach ($comments as $item) : ?>
                    <?php $usersSql = $db->prepare('SELECT * FROM users WHERE id = ? LIMIT 1');
                    $usersSql->execute([$item['user_id']]);
                    $users = $usersSql->fetch(PDO::FETCH_ASSOC); ?>
                    <div class="comment-item">
                        <div class="comment-info">
                            <div class="user-name">
                                <?php echo $users['name'] ?>
                            </div>

                            <div class="fav-icon">
                                <?php for ($i = 1; $i <= $item['rating']; $i++): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                <?php for ($j = 1; $j <= 5 - $item['rating']; $j++): ?>
                                    <i class="fas fa-star muted-star"></i>
                                <?php endfor; ?>
                            </div>

                        </div>
                        <div class="description mt-3">
                            <?php echo $item['content'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <p><?php echo 'bu ürüne daha önce hiç yorum yapılmadı. 😔' ?></p>
            <?php endif; ?>
        </div>


    </div>

<?php


?>


<?php include "footer.php"; ?>