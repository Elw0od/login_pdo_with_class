<?php

Class DBConnect {
    public function Database(){
        $dbhost = "localhost";
        $dbname = "test";
        $dbuser = "root";
        $dbpass = "";

        try {
            $dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
            $dbConnection->exec("set names utf8");
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
        }
        catch (PDOException $e) {
            echo '🔥🔥🔥' . $e->getMessage();
        }
    }
}

?>