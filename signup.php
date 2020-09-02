<?php
require 'database.php';

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    echo $password;
    $stmt->bindParam(':password', $password);

    //var_dump($stmt);
    if ($stmt->execute()) {
        $message = 'Usuario nuevo creado exitosamente!';
    } else {
        $message = 'Error en la creacion de usuario';
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SignUp</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>

        <?php require 'partials/header.php' ?>

        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>

        <h1>Registrarse</h1>
        <span>or <a href="login.php">Entrar</a></span>

        <form action="signup.php" method="POST">
            <input name="email" type="text" placeholder="Ingrese su email">
            <input name="password" type="password" placeholder="Ingrese su Password">
            <input name="confirm_password" type="password" placeholder="confirme su Password">
            <input type="submit" value="Enviar">
        </form>
        <?php require 'partials/footer.php' ?>
    </body>
</html>