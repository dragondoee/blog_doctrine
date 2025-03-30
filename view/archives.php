

<span class="liste-salles">
    <?php


    if ($result) {
        foreach ($result as $billet) {
            require "carte_billet.php";
        }
    } else {
        echo "Aucun résultat trouvé";
    }


    ?>
</span>