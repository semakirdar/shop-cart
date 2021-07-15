<?php include 'header.php'; ?>

<div class="container">
    <div class="login">
        <h4 class="text-center">LOGIN</h4>
        <form method="post">
            <label>Email:</label>
            <input name="email">
            <label>Password:</label>
            <input type="password" name="password">
            <button type="submit">LOGIN</button>
        </form>
    </div>
</div>

<?php

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    header('location:index.php');
}

if (isset($_POST['email'])) {
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    if (empty($email)) {
        $_SESSION['errors'] = 'email boş geçilemez';
    }
    if (empty($password)) {
        $_SESSION['errors'] .= 'password boş geçilemez';
    }

    if (empty($_SESSION['errors'])) {
        $checkUserSql = $db->prepare('SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1');
        $checkUserSql->execute([$email, $password]);

        if ($checkUserSql->rowCount() == 1) {
            $user = $checkUserSql->fetch(PDO::FETCH_ASSOC);

            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $email;
            $_SESSION['loggedIn'] = true;
        }
        else
            $_SESSION['errors'] .= 'kullanıcı bulunamadı.';
    }
    header('location:index.php');
}


?>

<?php include 'footer.php'; ?>
