<?php

include_once '../inc/header.inc';
include '../bdd/fonctionsBDD.php';
if (isset($_SESSION['login'])) {
    echo '<div class="subpart"><h3>Connecté en tant que ' . $_SESSION['login'] . '</h3></div><br>
    <div class="subpart">
    <p><a href="ajoutActivites.php">Ajouter une activite</a><br>
    <a href="ajoutAnim.php">Ajouter un animateur</a><br>
    <a href="ajoutEvenement.php">Ajouter un évenement</a></p>
    </div>';
}
include_once '../inc/footer.inc';
