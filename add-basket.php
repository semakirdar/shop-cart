<?php include 'header.php'; ?>
<?php
$productId = $_GET['productId'];

if (isset($_GET['productId'])) {
    if (!isset($_SESSION['basket']))
        $_SESSION['basket'] = [];

    if (!in_array($productId, $_SESSION['basket']))
        array_push($_SESSION['basket'], $productId);



}
header('location:index.php');

?>
<?php include 'footer.php'; ?>
