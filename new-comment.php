<?php include 'header.php'; ?>

<?php
if (isset($_POST['content'])) {

    $content = strip_tags(trim($_POST['content']));
    $product_id = strip_tags(trim($_POST['product_id']));
    $rating = strip_tags(trim($_POST['rating']));


    if (empty($content)) {
        $_SESSION['errors'] = 'Yorum alanı boş geçilemez ';
    } else {
        $addCommentSql = $db->prepare('INSERT INTO comments (product_id, content, rating, user_id) VALUES (?, ?, ?, ?)');
        $addCommentSql->execute([$product_id, $content, $rating, $_SESSION['id']]);
    }

    header('location:product-detail.php?product_id='.$product_id);

}


?>


<?php include 'footer.php'; ?>
