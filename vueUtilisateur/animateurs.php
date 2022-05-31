<?php 
include_once '../inc/header.inc';
include_once '../bdd/fonctionsBDD.php';
?>
<div class='subpart'><h2>Qui sont nos Animateurs ?</h2></div><br>
<?php
$LesAnim = getAnim();
foreach ($LesAnim as $UnAnim) {
    echo'<div class="subpart">
            <div class="right animateur">
                <img src=../img/anim/' . $UnAnim['imgAnim'] . ' alt ="' . $UnAnim['prenom'] . '"> 
                <h2>'. $UnAnim['prenom'] .' '. $UnAnim['nom'] . '</h2>
            </div>
            <p>'.$UnAnim['description'].'</p>
        </div>';
}
include_once '../inc/footer.inc';