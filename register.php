<?php include 'header.php'; ?>
<div class="container">
    <div class="register">
        <h4 class="text-center mb-4">REGISTER</h4>
        <form method="post">
            <label>Name:</label>
            <input name="name">
            <label>Email:</label>
            <input name="email">
            <label>Password:</label>
            <input type="password" name="password">
            <label>Password Again:</label>
            <input type="password" name="passwordAgain">
            <button type="submit">SUBMIT</button>
        </form>
    </div>
</div>

<?php
if (isset($_POST['name'])) {
    $name = strip_tags($_POST['name']);
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    $passwordAgain = strip_tags($_POST['passwordAgain']);
    $errors = '';

    if (empty($name)) {
        $errors .= ' name boş geçilemez';
    }
    if (empty($email)) {
        $errors .= 'email boş geçilemez';
    }
    if (empty($password)) {
        $errors .= 'password boş geçilemez';
    }
    if (empty($passwordAgain)) {
        $errors .= 'password Again boş geçilemez';
    }
    if (empty($errors)) {
        $addUserSql = $db->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
        $addUserSql->execute([$name, $email, $password]);
    }

    $_SESSION['errors'] = $errors;

}


?>

<?php include 'footer.php'; ?>
