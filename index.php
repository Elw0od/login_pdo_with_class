<?php

require('Class/UserLogin.php');
$userLogin = new UserLogin();

$error = "";

if(!empty($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(strlen(trim($email)) > 1 && strlen(trim($password)) > 1) {
        $user = $userLogin->Login($email, $password);
        if($user) {
            header("Location: dashboard.php");
        } else {
            $error = "💩💩💩, identifiant non valide";
        }
    } else {
        $error = "🔥🔥🔥 information non valide";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="" method="post" name="login">
        <label for="email">Email</label>
        <input type="text" name="email">
        <label for="password">Mot de passe</label>
        <input type="password" name="password">
        <input type="submit" class="button" name="submit" value="Login">
    </form>
    <div><?php echo $error; ?></div>
    <a href="register.php">S'enregistrer</a>
</body>
</html>