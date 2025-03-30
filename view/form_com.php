
<?php
 
if (isset($commentaire)) {
    ?>

    <form class="form_com" method="POST" action="index.php?action=ModifCom&id_billet=<?= $billet->getId(); ?>&modif=<?= $commentaire->getId() ?>">
        <div>
            <label for="addCom">Commentaire</label>
            <textarea name="addCom" id="addCom" cols="100" rows="2"> <?= $commentaire->getCom() ?> </textarea>
            <input type="submit">
    </form>

    <?php
} else {
    ?>
    <form class="form_com" method="POST" action="index.php?action=addCom&id_billet=<?= $billet->getId(); ?>">
        <!-- <label for="addCom">Commentaire</label> -->
        <textarea name="addCom" id="addCom" placeholder="Ajoutez un commentaire" required></textarea>
        <input type="submit">
    </form>
    <?php
}
?>