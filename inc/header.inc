<?php define('SCRIPT_ROOT', 'http://localhost/SiteArtanime'); ?>

<!DOCTYPE html>

<html>

    <head>

        <title>Artanime</title>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <header>

        <?php echo '<link href="' . SCRIPT_ROOT . '/css/css.css" rel="stylesheet">'; ?>

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css'>

        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>

        

        <div class="menu">

            <ul>

                <?php
                echo '
                <li><a href="' . SCRIPT_ROOT . '/index.php">Accueil</a></li>
                    
                <li><a href="' . SCRIPT_ROOT . '/vueUtilisateur/evenements.php">Évenements</a></li>
                    
                <li><a href="' . SCRIPT_ROOT . '/vueUtilisateur/activites.php">Activités</a></li>
                    
                <li><a href="' . SCRIPT_ROOT . '/vueUtilisateur/personnel.php">Personnel</a></li>
                                        
                <li><a href="' . SCRIPT_ROOT . '/vueUtilisateur/adhesion.php">Adhésion</a></li>';

                session_start();

                if (isset($_SESSION['login'])) {

                    echo '<li><a href="' . SCRIPT_ROOT . '/vueControlleur/admin.php">Administration</a></li>
                        
                    <li><a href="' . SCRIPT_ROOT . '/bdd/deconnexion.php">Se Deconnecter</a></li>';
                } else {

                    echo '<li><a href="' . SCRIPT_ROOT . '/login.php">Se Connecter</a></li>';
                }
                ?>

            </ul>

        </div>

    </header>

    <body>

        <div class='wrapper'>

            <?php
            echo '<img class = "logo" src = "' . SCRIPT_ROOT . '/img/artanimelogo.png" alt = "artanime">';
            