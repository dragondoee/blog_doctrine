<?php
echo "<div class='list-com'>";
if (empty($com)) {
    if (isset($_SESSION["login"])) {
        echo "<p>Aucun commentaire, soyez le 1er</p>";
    } else {
        echo "<p>Aucun commentaire</p>";
    }
} else {
    foreach ($com as $commentaire) {
        $user = $entityManager->getRepository('User')->find($commentaire->getAuteur());
        $userCom = $user->getLogin();
        ?>

            <div class="com-unique">

                <img class="pp" src="<?php
                echo file_exists("img/profil/{$userCom}.jpg")
                    ? "img/profil/{$userCom}.jpg"
                    : (file_exists("img/profil/{$userCom}.png")
                        ? "img/profil/{$userCom}.png"
                        : "img/profil/default.jpg"); ?>" alt="photo de profil de <?= htmlspecialchars($userCom) ?>">
                <span class="content-com">
                    <span class="top-part-com">
                        <p class="comment-author"><strong><?= $userCom ?></strong></p>
                        <p class="date ">Publié le <?= $commentaire->getDate()->format('d/m/Y \à H\hi'); ?></p>
                    </span>
                    <p><?= $commentaire->getCom(); ?></p>
                </span>

                <?php
                if (isset($_SESSION["login"])) {
                    if ($_SESSION["login"] == "admin") {
                        ?>
                        <span class='admin-button-com'>
                            <a
                                href='index.php?action=suprCom&supr=<?= $commentaire->getId(); ?>&id_billet=<?= $billet->getId(); ?>'>
                                <img src="img/delete.svg" alt="supprimer le commentaire" title="Supprimer le commentaire">
                            </a><br>
                            <a
                                href='index.php?action=form_com&modif=<?= $commentaire->getId(); ?>&id_billet=<?= $billet->getId(); ?>'>
                                <img src="img/edit.svg" alt="modifier le commentaire" title="Modifier le commentaire">
                            </a><br>
                        </span>
                        <?php
                    }
                }
                ?>

            </div>

        <?php
    }
    
}
echo  "</div>"  ;
?>