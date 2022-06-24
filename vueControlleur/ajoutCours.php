<?php
include_once '../inc/header.inc';
include '../bdd/fonctionsBDD.php';
?>

<div class="subpart">

    <form action="#" method="post" enctype="multipart/form-data">

        <label for="day">Choisir le jour :</label><br>
        <select name="day" id="day" style="margin-left: 70px;">
            <option value="1">Lundi</option>
            <option value="2">Mardi</option>
            <option value="3">Mercredi</option>
            <option value="4">Jeudi</option>
            <option value="5">Vendredi</option>
            <option value="6">Samedi</option>
            <option value="0">Dimanche</option>
        </select><br>

        <label for="hDebut"> Horaires : </label>
        <p>De <input type="text" id="hDebut" name="hDebut" maxlength="2" style="width: 50px;" class="horaire"> : <input type="text" id="minDebut" name="minDebut" maxlength="2" style="width: 50px;" class="horaire"><br>  à <input type="text" id="hFin" name="hFin" maxlength="2" style="width: 50px;" class="horaire"> : <input type="text" id="minFin" name="minFin" maxlength="2" style="width: 50px;" class="horaire"></p>

        <label for="lieu">Lieu :</label><br>
        <input type="text" id="lieu" name="lieu" maxlength="60"><br>

        <label for="actSelect">Choisir une Activitée :</label><br>
        <select name="actSelect" id="actSelect" style="margin-left: 70px;">
            <?php
            $LesAct = getActivites();
            foreach ($LesAct as $uneAct) {
                echo'<option value ="' . $uneAct['idActivites'] . '">' . $uneAct['titre'] . '</option>';
            }
            ?>
        </select><br>

        <label for="animSelect">Choisir un Encadrant :</label><br>
        <select name="animSelect" id="animSelect" style="margin-left: 70px;">
            <?php
            $LesAnim = getAnim();
            foreach ($LesAnim as $unAnim) {
                echo'<option value ="' . $unAnim['idAnim'] . '">' . $unAnim['nom'] . ' ' . $unAnim['prenom'] . '</option>';
            }
            ?>
        </select><br>

        <label for="lvl">Niveau :</label><br>
        <input type="text" id="lvl" name="lvl"><br>

        <div class="file"><input type="submit" value="Valider"></div>
        
    </form>

</div>
<?php
if (isset($_POST['day']) && isset($_POST['hDebut']) && isset($_POST['hFin']) && isset($_POST['lieu']) && isset($_POST['actSelect']) && isset($_POST['animSelect']) && isset($_POST['lvl'])) {
    $day = $_POST['day'];
    $hDebut = $_POST['hDebut'].':'.$_POST['minDebut'];
    $hFin = $_POST['hFin'].':'.$_POST['minFin'];
    $addresse = $_POST['lieu'];
    $activite = $_POST['actSelect'];
    $animateur = $_POST['animSelect'];
    $niveau = $_POST['lvl'];
    addCours($day, $hDebut, $hFin, $addresse, $activite, $animateur, $niveau);
}
    