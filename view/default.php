<!-- Vu par défault / Page accueil -->
<h1 id="content">CyberBlog 2059</h1>
<?php
if (isset($_SESSION["login"])) {
    echo "<div class='bjr'> <p>Bonjour {$_SESSION["login"]}, <br> voici les 3 posts les plus récents </p>";
    if ($_SESSION["login"] == "admin") {
        ?>
        <a class="button button-style addPost" href='index.php?action=form_billet'>
            <img src="img/add.svg" alt="Ajouter un billet"> Ajouter un post
        </a>
    
        <?php
    }
    echo "</div>";

}

?>

<span class="liste-billet">
    <?php


    if (isset($result)) {
        foreach ($result as $billet) {
            require "view/carte_billet.php";
        }
        ;
    } else {
        echo "Aucun résultat trouvé";
    }
    ?>
</span>
<a href="index.php?action=archives " class="button-style centerElem">Découvrir les autres billets</a>