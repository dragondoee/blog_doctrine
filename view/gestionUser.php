<table>
    <tbody>
        <tr>
            <td>Photo de profil</td>
            <td>login</td>
            <td>supprimer</td>
        </tr>

        <?php
        foreach ($users as $user) {
            $photo = file_exists("img/profil/{$user->getLogin()}.jpg")
                ? "img/profil/{$user->getLogin()}.jpg"
                : (file_exists("img/profil/{$user->getLogin()}.png")
                    ? "img/profil/{$user->getLogin()}.png"
                    : "img/profil/default.jpg");

            ?>
            <tr>
                <td><img class='pp gestUser-pp' src='<?= $photo ?>' alt='photo de profil de <?= $user->getLogin() ?>'> </td>
                <td><?= $user->getLogin(); ?></td>
                <td><?php if ($user->getLogin() != "admin") {
                    echo "<a href='index.php?action=gestionUser&gestion=user&supr={$user->getId()}'> <img src='img/delete.svg' alt='img cliquable pour supprimer l'utilisateur' title='Supprimer'> </a><br>";
                } ?>

                </td>
            </tr>


            <?php
        }

        ?>
    </tbody>
</table>