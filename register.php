<?php

require('Class/UserRegistration.php');
$userRegistration = new UserRegistration();

$error = "";
$success = "";
if(!empty($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userCheck = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
    $emailCheck = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);

    if($userCheck && $emailCheck) {
        $user = $userRegistration->Registration($username, $email, $password);
        if($user) {
            $success = '👌 bienvenue';
        } else {
            $error = '🔥💩🔥 email ou username déjà existant';
        }
    } else {
        $error = '🔥🔥🔥 information non valide';
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>S'inscrire</title>
</head>
<body>
    <form action="" method="post" name="register">
        <label for="username">Username</label>
        <input type="text" name="username">
        <label for="email">Email</label>
        <input type="text" name="email">
        <label for="password">Mot de passe</label>
        <input type="password" name="password">
        <input type="submit" class="button" name="submit" value="Register">
    </form>
    <div><?php echo $error; ?></div>
    <div><?php echo $success; ?></div>
    <a href="index.php">Se connecter</a>
</body>
</html>