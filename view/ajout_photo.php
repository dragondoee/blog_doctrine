<?php

if (isset($_SESSION["login"])) {

    // Répertoire de stockage des images de profil
    $content_dir = 'img/profil/';

    // Vérifie si un fichier a été envoyé
    if (isset($_FILES["image"])) {

        // Récupérer l'extension du fichier téléversé
        $fileExtension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

        // Valider le type de fichier
        $allowedExtensions = ["jpg", "png"];
        if (!in_array($fileExtension, $allowedExtensions)) {
            exit("Le format de fichier n'est pas autorisé. Seules les images (jpg, jpeg, png) sont acceptées.");
        }

        // Construire le nom du fichier en fonction de l'utilisateur (conserver l'extension originale)
        $nom_fichier = strval($_SESSION["login"]) . "." . $fileExtension;

        // Supprimer l'ancienne image de l'utilisateur si elle existe (peu importe le format)
        $existingFileJpg = $content_dir . strval($_SESSION["login"]) . ".jpg";
        $existingFilePng = $content_dir . strval($_SESSION["login"]) . ".png";

        if (file_exists($existingFileJpg)) {
            unlink($existingFileJpg); // Supprimer le fichier JPG si présent
        }

        if (file_exists($existingFilePng)) {
            unlink($existingFilePng); // Supprimer le fichier PNG si présent
        }

        // Déplacement du fichier téléversé
        $tmp_file = $_FILES['image']['tmp_name'];
        if (!is_uploaded_file($tmp_file)) {
            exit("Le fichier est introuvable.");
        }

        // Déplacer le fichier téléchargé vers le répertoire de stockage avec le bon nom
        if (!move_uploaded_file($tmp_file, $content_dir . $nom_fichier)) {
            exit("Impossible de copier le fichier dans $content_dir");
        }

    } else {
        exit("Aucun fichier n'a été téléversé.");
    }
}
