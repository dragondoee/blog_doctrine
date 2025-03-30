<header class="composant-header">
    <a href="#content" class="skip-link">Aller au contenu</a>
    <nav>
        <a class="retourAccueil" href="index.php"><img src="img/logo-full.png" alt="retour à l'accueil"></a>
        <ul>
            <li><a href="index.php?action=archives"><img class="ico-nav" src="img/archive.svg" alt="image cliquable vers archives"
                        title="Archives"></a></li>
            <?php
            if (isset($_SESSION["login"])) {
                if ($_SESSION["login"] == "admin") {
                    ?>
                    <li><a href="index.php?action=gestionUser"><img class="ico-nav" src="img/manage_accounts.svg" alt="image cliquable vers liste utilisateurs"
                                title="Liste Utilisateurs"></a></li>
                    <?php
                } ?>
                <li><a href="index.php?action=profil"><img class="ico-nav pp" src="img/account_circle.svg" alt="image cliquable vers profil" title="Profil"></a></li>
                <li><a href="index.php?action=deconnexion"><img class="ico-nav" src="img/logout.svg" alt="image cliquable pour se déconnecter" title="Se déconnecter"></a>
                </li>
                <?php
            } else {
                ?>
                <li><a href="index.php?action=login"><img class="ico-nav" src="img/account_circle.svg" alt="image cliquable vers profil" title="Se connecter"></a></li>
                <?php
            }
            ?>


        </ul>
    </nav>
</header>