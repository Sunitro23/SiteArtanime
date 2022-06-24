<?php include_once '../inc/header.inc'; ?>

<div class="subpart">
    <h2>Ajouter un Évenement</h2>
    <form action="#" method="post" enctype="multipart/form-data">

        <label for="titre"> Titre : </label><br>
        <input type="text" id="titre" name="titre" maxlength="30"><br>

        <label for="date"> Date : </label><br>
        <input id="date" name="date" type="date"><br>

        <label for="horaires"> Horaires : </label><br>
        <p>De <input type="text" id="hDebut" name="hDebut" maxlength="2" style="width: 50px;" class="horaire"> : <input type="text" id="minDebut" name="minDebut" maxlength="2" style="width: 50px;" class="horaire"><br>  à <input type="text" id="hFin" name="hFin" maxlength="2" style="width: 50px;" class="horaire"> : <input type="text" id="minFin" name="minFin" maxlength="2" style="width: 50px;" class="horaire"></p>
        <label for="addresse"> Addresse : </label><br>
        <input type="addresse" id="addresse" name="addresse" maxlength="60"><br>

        <label for="decription"> Description : </label><br>
        <textarea id="description" name="description" rows="5" cols="33" maxlength="4000"></textarea><br>

        <div class="file">
            <label for='actual-btn' class='label'> Choisir l'image : </label>
            <input type="file" name="fichier" id="actual-btn" hidden/>
            <span id="file-chosen">Aucune image choisie </span>
        </div><br>

        <div class="file"><input type="submit" value="Valider"></div>

    </form>
</div>

<script>
    const actualBtn = document.getElementById('actual-btn');
    const fileChosen = document.getElementById('file-chosen');
    actualBtn.addEventListener('change', function () {
        fileChosen.textContent = this.files[0].name;
    });
</script>

<?php
include_once '../bdd/fonctionsBDD.php';

if (isset($_POST['titre']) && isset($_POST['date']) && isset($_POST['hDebut']) && isset($_POST['hFin']) && isset($_POST['addresse']) && isset($_POST['description']) && isset($_FILES['fichier'])) {

    try {

        if (empty($_POST['titre']) || empty($_POST['date']) || empty($_POST['hDebut']) || empty($_POST['addresse']) || empty($_POST['description'])) {

            throw new RuntimeException('Veuillez remplir toutes les valeurs.');
        } else {

            if (
                    !isset($_FILES['fichier']['error']) ||
                    is_array($_FILES['fichier']['error'])
            ) {
                throw new RuntimeException('Paramètres Invalides.');
            }

            switch ($_FILES['fichier']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('Aucun fichier envoyé.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Taille du fichier trop grande.');
                default:
                    throw new RuntimeException('Erreur inconnue.');
            }
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                    $finfo->file($_FILES['fichier']['tmp_name']),
                    array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                        'webp' => 'image/webp',
                    ),
                    true
                    )) {
                throw new RuntimeException('Format invalide.');
            }

            $filename = $_FILES["fichier"]["name"];
            $tempname = $_FILES["fichier"]["tmp_name"];
            $folder = "C://wamp64/www/SiteArtanime/img/event/" . $filename;
            move_uploaded_file($tempname, $folder);

//Ajout BDD

            if (isset($_POST['minDebut'])) {
                $minDebut = $_POST['minDebut'];
            } else {
                $minDebut = '00';
            }
            if (isset($_POST['minFin'])) {
                $minFin = $_POST['minFin'];
            } else {
                $minFin = '00';
            }
            $titre = $_POST['titre'];
            $date = $_POST['date'];
            $hDebut = $_POST['hDebut'] . ':' . $minDebut;
            $hFin = $_POST['hFin'] . ':' . $minFin;
            $horaires = $hDebut . ' à ' . $hFin;
            $addresse = $_POST['addresse'];
            $description = $_POST['description'];
            addEvent($titre, $date, $horaires, $addresse, $description, $filename);
        }
    } catch (RuntimeException $e) {
        echo '<script>alert("' . $e->getMessage() . '");</script>';
    }
}
