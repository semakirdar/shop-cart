<?php include 'header.php'; ?>
<?php
$productId = $_GET['productId'];

$productIndex = array_search($productId, $_SESSION['basket']);

if ($productIndex !== false) {
    unset($_SESSION['basket'][$productIndex]);
}
header('location:basket.php');
?>

<?php include 'footer.php'; ?>
