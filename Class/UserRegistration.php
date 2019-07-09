<?php

require_once('DBConnect.php');

Class UserRegistration extends DBConnect{
    public function Registration($username, $email, $password) {
        try {
            $dbConnection = $this->Database();
            $db = $dbConnection->prepare('SELECT username, email FROM users WHERE username = :username OR email = :email');
            $db->bindParam(":email", $email, PDO::PARAM_STR);
            $db->bindParam(":username", $username, PDO::PARAM_STR);
            $db->execute();

            $count = $db->rowCount();
            if($count < 1){
                $db = $dbConnection->prepare('INSERT INTO users(username, email, password, created_at) VALUES(:username, :email, :password, :created_at)');
                $created_at = date('Y-m-d H:i:s'); // Je donne un format à la date de creation de l'utilisateur
                $hash = hash('sha256', $password); // Permet de crypter le mot de passe
                $db->bindParam(':username', $username, PDO::PARAM_STR);
                $db->bindParam(':email', $email, PDO::PARAM_STR);
                $db->bindParam(':password', $hash, PDO::PARAM_STR);
                $db->bindParam(':created_at', $created_at, PDO::PARAM_STR);
                $db->execute();

                $count = $db->rowCount();
                if($count == 1) {
                    $user= $dbConnection->lastInsertId(); 
                    $dbConnection = null;
                    $_SESSION['username']=$user;
                    return true;
                } else {
                    $dbConnection = null;
                    return false;
                }
            } else {
                $dbConnection = null;
                return false;
            }

        } 
        catch (PDOException $e) {
            echo '🔥💩🔥' . $e->getMessage();
        }
    }
}

?>