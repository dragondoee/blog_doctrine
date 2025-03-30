<?php
if (isset($_SESSION["login"])) {
    echo "<h1>Bonjour {$_SESSION["login"]} </h1>";
    $photo = file_exists("img/profil/{$user->getLogin()}.jpg")
                ? "img/profil/{$user->getLogin()}.jpg"
                : (file_exists("img/profil/{$user->getLogin()}.png")
                    ? "img/profil/{$user->getLogin()}.png"
                    : "img/profil/default.jpg");
    echo "<div class='profil'> <img class='pp profil-pp' src='{$photo}' alt='photo de profil de {$_SESSION["login"]}'>";
    echo "Login : {$user->getLogin()} <br> ";
    echo "<a class='button-style' href='index.php?action=form_pp'>Modifier sa photo</a> ";
    echo "</div>";

    ?>

    

    <?php

} else {
    echo "Vous devez vous connecter pour voir votre profil";
}



?>