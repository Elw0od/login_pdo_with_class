<?php
    require_once("Config/session.php");
?>
<h1> Bienvenue, <span style="color:red;"><?php echo $_SESSION['username'] ; ?></span></h1>

<br>
<a href="logout.php">Déconnexion</a>