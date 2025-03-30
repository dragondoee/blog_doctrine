<div class="billet">
    <div>
        <span>
            <h2><a href="index.php?action=detail&id_billet=<?= $billet->getId(); ?>"><?= $billet->getTitre(); ?></a>
            </h2>
            <p class="date-publication">publié le <?= $billet->getDate()->format('d/m/Y \à H\hi'); ?></p>
            <p><?= mb_strlen($billet->getText(), 'UTF-8') > 100 ? mb_substr($billet->getText(), 0, 100, 'UTF-8') . "..." : $billet->getText();
            ?></p>
        </span>
    </div>

    <a class="button-style small-button centerElem" href="index.php?action=detail&id_billet=<?= $billet->getId(); ?>">Lire plus</a>

    <?php
    if (isset($_SESSION["login"])) {
        if ($_SESSION["login"] == "admin") {
            ?>
            <span class=" admin-button-billet">
                <a class="button-style" href='index.php?action=suprBillet&supr=<?= $billet->getId() ?>'>
                    <img src="img/delete.svg" alt="supprimer le billet" title="Supprimer le billet">
                </a><br>
                <a class="button-style" href='index.php?action=form_billet&modif=<?= $billet->getId() ?>'>
                    <img src="img/edit_note.svg" alt="modifier le billet" title="Modifier le billet">
                </a><br>
            </span>

            <?php
        }
    }

    ?>   
</div>