<?php include 'header.php'; ?>
<?php
$product_id = $_GET['product_id'];

if (isset($_GET['product_id'])) {
    $checkFavoritesSql = $db->prepare('SELECT * FROM favorites WHERE product_id = ? AND user_id = ?');
    $checkFavoritesSql->execute([$product_id, $_SESSION['id']]);

    if ($checkFavoritesSql->rowCount() == 1) {
        $checkFavorite = $checkFavoritesSql->fetch(PDO::FETCH_ASSOC);

        $deleteFavoritesSql = $db->prepare('DELETE FROM favorites WHERE id = ? LIMIT 1');
        $deleteFavoritesSql->execute([$checkFavorite['id']]);
    } else {
        $addFavoritesSql = $db->prepare('INSERT INTO favorites (user_id, product_id) VALUES(?,?)');
        $addFavoritesSql->execute([$_SESSION['id'],$product_id]);

    }

header('location:index.php?favorited=true');
}
?>


<?php include 'footer.php'; ?>
