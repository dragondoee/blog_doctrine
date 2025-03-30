
<?php
if(isset($billet)){
?>

<form method="POST" action="index.php?action=ModifBillet">
    <div>
        <label for="titre" >Titre</label>
        <input type="titre" id="titre" name="titre" require value="<?= $billet->getTitre() ?>">
    </div>
    <div>
        <label for="texte">Texte</label>
        <textarea name="texteBillet" id="texte" cols="100" rows="7" require><?= $billet->getText() ?></textarea>
    </div>
    <div><input type="hidden" name="id_billet" value="<?= $billet->getId() ?>"></div>
    <div><input type="submit"></div>
</form>

<?php
} else {
    ?>
    <form method="POST" action="index.php?action=addBillet">
    <div>
        <label for="titre">Titre</label>
        <input type="titre" id="titre" name="titre" required>
    </div>
    <div>
        <label for="texte">Texte</label>
        <textarea name="texteBillet" id="texte" cols="100" rows="10" required></textarea>
    </div>
    <div><input type="submit"></div>
</form>
<?php
}
?>