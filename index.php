<!DOCTYPE html>
<html lang="fr">
<?php
require_once "bootstrap.php";
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Style -->
    <link rel="stylesheet" href="style.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="/img/logo.png" type="image/x-icon">
    <!-- Typo -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <!--  -->
    <title>CyberBlog 2059</title>
</head>

<body>
    <main>
        <?php

        if (isset($_GET["action"])) {
            $action = $_GET["action"];

            switch ($action) {
                // Archives
                case "archives":
                    $result = $entityManager->getRepository('Billet')->findAll();
                    require_once "view/header.php";
                    require "view/archives.php";
                    break;
                // Login
                case "login":
                    if (isset($_POST["login"])) {
                        if ($user = $entityManager->getRepository('User')->findOneBy(array('login' => $_POST["login"]))) {
                            if (password_verify($_POST["mdp"], $user->getMdp())) {
                                $_SESSION["login"] = $_POST["login"];
                            } else {
                                $msg = "err-mdp";
                            }
                            ;
                        } else {
                            $msg = "err-login";
                        }
                    }
                    if (isset($_SESSION["login"])) {
                        $result = $entityManager->getRepository('Billet')->findBy([], ['date' => 'DESC'], 3);
                        require_once "view/header.php";
                        require "view/default.php";
                    } else {
                        require_once "view/header.php";
                        require "view/login.php";
                    }

                    break;
                // Inscription
                case "inscription":
                    if (isset($_POST["login"])) {
                        if (empty($entityManager->getRepository('User')->findOneBy(array('login' => $_POST["login"])))) {

                            if ($_POST["mdp"] == $_POST["conf"]) {
                                $user = new User();
                                $user->setLogin($_POST["login"]);
                                $user->setMdp(password_hash($_POST["mdp"], PASSWORD_DEFAULT));

                                $entityManager->persist($user);
                                $entityManager->flush();
                                if ($user = $entityManager->getRepository('User')->findOneBy(array('login' => $_POST["login"]))) {
                                    $_SESSION["login"] = $_POST["login"];
                                }

                            } else {
                                $msg = "err-mdp";
                            }

                        } else {
                            $msg = "err-login";
                        }
                    }
                    if (isset($_SESSION["login"])) {
                        $result = $entityManager->getRepository('Billet')->findBy([], ['date' => 'DESC'], 3);
                        require_once "view/header.php";
                        require "view/default.php";
                    } else {
                        require_once "view/header.php";
                        require "view/inscription.php";
                    }

                    break;
                // Formulaire billet
                case "form_billet":
                    if (isset($_GET["modif"])) {
                        $id_billet = $_GET["modif"];
                        $billet = $entityManager->getRepository('Billet')->find($id_billet);
                    }
                    require_once "view/header.php";
                    require "view/form_billet.php";
                    break;
                // Ajouter un billet
                case "addBillet":
                    if (isset($_POST["texteBillet"])) {
                        $billet = new Billet();
                        $billet->setTitre($_POST["titre"]);
                        $billet->setDate(new DateTime("now"));
                        $billet->setText($_POST["texteBillet"]);

                        $entityManager->persist($billet);
                        $entityManager->flush();
                        $result = $entityManager->getRepository('Billet')->findBy([], ['date' => 'DESC'], 3);
                        require_once "view/header.php";
                        require "view/default.php";
                    }
                    break;
                // Modifier un billet
                case "ModifBillet":
                    if (isset($_POST["texteBillet"])) {
                        $billet = $entityManager->getRepository('Billet')->find($_POST["id_billet"]);
                        $billet->setTitre($_POST["titre"]);
                        $billet->setText($_POST["texteBillet"]);

                        $entityManager->persist($billet);
                        $entityManager->flush();
                        $result = $entityManager->getRepository('Billet')->findBy([], ['date' => 'DESC'], 3);
                        require_once "view/header.php";
                        require "view/default.php";
                    }
                    break;
                // supr_billet
                case "suprBillet":
                    if (isset($_GET["supr"])) {
                        $billet = $entityManager->getRepository('Billet')->find($_GET["supr"]);
                        $entityManager->remove($billet);
                        $entityManager->flush();

                        $result = $entityManager->getRepository('Billet')->findBy([], ['date' => 'DESC'], 3);
                        require_once "view/header.php";
                        require "view/default.php";
                    }
                    break;
                // Detail
                case "detail":
                    $billet = $entityManager->getRepository('Billet')->find($_GET["id_billet"]);
                    if ($entityManager->getRepository('Commentaire')->findBy(array('billet' => $billet->getId()), ['date' => 'DESC'])) {
                        $com = $entityManager->getRepository('Commentaire')->findBy(array('billet' => $billet->getId()), ['date' => 'DESC']);
                    } else {
                        $com = NULL;
                    }
                    require_once "view/header.php";
                    require "view/detail.php";
                    if (isset($_SESSION["login"])) {
                        require "view/form_com.php";
                    }
                    require "view/commentaire.php";
                    break;
                // Ajouter un Commentaire
                case "addCom":
                    if (isset($_POST["addCom"])) {
                        $com = new Commentaire();
                        $com->setAuteur($entityManager->getRepository('User')->findOneBy(array('login' => $_SESSION["login"])));
                        $com->setDate(new DateTime("now"));
                        $com->setCom($_POST["addCom"]);
                        $com->setBillet($entityManager->getRepository('Billet')->find($_GET["id_billet"]));

                        $entityManager->persist($com);
                        $entityManager->flush();
                    }
                    $billet = $entityManager->getRepository('Billet')->find($_GET["id_billet"]);
                    $com = $entityManager->getRepository('Commentaire')->findBy(array('billet' => $billet->getId()), ['date' => 'DESC']);
                    require_once "view/header.php";
                    require "view/detail.php";
                    require "view/form_com.php";
                    require "view/commentaire.php";

                    break;
                // Formulaire Com
                case "form_com":
                    $billet = $entityManager->getRepository('Billet')->find($_GET["id_billet"]);
                    if (isset($_GET["modif"])) {
                        $id_com = $_GET["modif"];
                        $commentaire = $entityManager->getRepository('Commentaire')->find($id_com);
                    }
                    require_once "view/header.php";
                    require "view/form_com.php";
                    break;
                // Modifier un Commentaire
                case "ModifCom":
                    if (isset($_POST["addCom"])) {
                        $com = $entityManager->getRepository('Commentaire')->find($_GET["modif"]);
                        $com->setAuteur($entityManager->getRepository('User')->findOneBy(array('login' => $_SESSION["login"])));
                        $com->setCom($_POST["addCom"]);
                        $com->setBillet($entityManager->getRepository('Billet')->find($_GET["id_billet"]));

                        $entityManager->persist($com);
                        $entityManager->flush();
                        $billet = $entityManager->getRepository('Billet')->find($_GET["id_billet"]);
                        $com = $entityManager->getRepository('Commentaire')->findBy(array('billet' => $billet->getId()), ['date' => 'DESC']);
                        require_once "view/header.php";
                        require "view/detail.php";
                        require "view/form_com.php";
                        require "view/commentaire.php";
                    }
                    break;
                // supr_com
                case "suprCom":
                    if (isset($_GET["supr"])) {
                        $commentaire = $entityManager->getRepository('Commentaire')->find($_GET["supr"]);
                        $entityManager->remove($commentaire);
                        $entityManager->flush();
                        $billet = $entityManager->getRepository('Billet')->find($_GET["id_billet"]);
                        $com = $entityManager->getRepository('Commentaire')->findBy(array('billet' => $billet->getId()));
                        require_once "view/header.php";
                        require "view/detail.php";
                        require "view/form_com.php";
                        require "view/commentaire.php";
                    }
                    break;
                // Profil
                case "profil":
                    $user = $entityManager->getRepository('User')->findOneBy(array('login' => $_SESSION["login"]));
                    require_once "view/header.php";
                    require "view/profil.php";
                    break;
                case "form_pp":
                    require "view/form_pp.php";
                    break;
                case "photoProfil":
                    $user = $entityManager->getRepository('User')->findOneBy(array('login' => $_SESSION["login"]));
                    require_once "view/header.php";
                    require "view/ajout_photo.php";
                    require "view/profil.php";
                    break;
                // Gestion utilisateur
                case "gestionUser":
                    if (isset($_GET["supr"])) {
                        $user = $entityManager->getRepository('User')->find($_GET["supr"]);
                        $entityManager->remove($user);
                        $entityManager->flush();
                    }
                    ;
                    $users = $entityManager->getRepository('User')->findAll();
                    require_once "view/header.php";
                    require "view/gestionUser.php";
                    break;
                // deconnexion
                case "deconnexion":
                    $_SESSION["login"] = NULL;
                    $result = $entityManager->getRepository('Billet')->findBy([], ['date' => 'DESC'], 3);
                    require_once "view/header.php";
                    require "view/default.php";
                    break;

            }
        } else {
            $result = $entityManager->getRepository('Billet')->findBy([], ['date' => 'DESC'], 3);
            require_once "view/header.php";
            require "view/default.php";
        }


        ?>
    </main>

    <footer>
        Emilie Desgranges
    </footer>

</body>

</html>