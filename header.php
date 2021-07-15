<?php include 'config.php'; ?>
<?php
$checkCategorySql = $db->query('SELECT * FROM category');
$category = $checkCategorySql->fetchAll(PDO::FETCH_ASSOC);


?>
<link href="style.css" rel="stylesheet">
<link href="plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="plugins/fontawesome/css/all.min.css" rel="stylesheet">


<div class="nav-bar mb-4">
    <div class="nav-item">
        <a href="index.php" class="text-decoration-underline fw-semibold">SEMOSTREND</a>
    </div>
    <?php foreach ($category as $item): ?>
        <div class="nav-item">
            <a href="index.php?category_id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a>
        </div>
    <?php endforeach; ?>
    <div class="nav-item">
        <div class="nav-icons">
            <div class="icon-item">

                <?php if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false): ?>
                    <a href="login.php">
                        <i class="fas fa-user"></i>
                        <span>Giriş Yap</span>
                    </a>
                <?php else: ?>
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span><?php echo $_SESSION['name'] ?></span>
                    </a>

                <?php endif; ?>

            </div>
            <div class="icon-item">
                <a href="register.php">
                    <i class="fas fa-user-plus"></i>
                </a>
            </div>
            <div class="icon-item">
                <a href="index.php?favorited=true">
                    <i class="fas fa-heart"></i>
                    <span>Favoriler</span>
                </a>
            </div>
            <div class="icon-item">
                <a href="basket.php">
                    <i class="fas fa-shopping-basket"></i>
                    <span>Sepetim</span>
                </a>
            </div>
        </div>

    </div>
</div>

<?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) : ?>
    <div class="messages">
        <?php echo $_SESSION['errors']; ?>
    </div>
    <?php $_SESSION['errors'] = ''; ?>
<?php endif; ?>
