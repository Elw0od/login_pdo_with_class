<?php

require_once('DBConnect.php');

Class UserLogin extends DBConnect {
    public function Login($email, $password) {
        try {
            $dbConnection = $this->Database();
            $db = $dbConnection->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
            $hash = hash('sha256', $password);
            $db->bindParam(':email', $email, PDO::PARAM_STR);
            $db->bindParam(':password', $hash, PDO::PARAM_STR);
            $db->execute();

            $count = $db->rowCount();
            $data = $db->fetch(PDO::FETCH_OBJ);
            if($count == 1) {
                session_start();
                $dbConnection = null;
                $_SESSION['username']=$data->username; // -On stock la valeur de la session utilisateur
                return true;
            } else {
                $dbConnection = null;
                return false;
            }

        } catch (PDOException $e) {
            echo '🔥💩🔥' . $e->getMessage();
        }
    }
}

?>