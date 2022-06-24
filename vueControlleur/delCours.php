<?php
include_once '../inc/header.inc';
include_once '../bdd/fonctionsBDD.php';
?>
<div class="subpart">

    <h2>Supprimer un cours</h2>

    <form action="#" method="post" enctype="multipart/form-data">

        <label for="cours">Selectionner le cours</label><br>

        <div class="file"><select name="cours" id="cours">

                <?php
                $LesCours = getLesCours();

                foreach ($LesCours as $UnCours) {

                    $day = getDay($UnCours['jour']);

                    echo'<option value ="' . $UnCours['idCours'] . '">' . $UnCours['titre'] . ' à ' . $UnCours['heureDebut'] . ' le ' . $day . '</option>';
                }
                ?>

            </select><br></div>
        <div class="file"><input type="submit" value="Valider"></div>

    </form>

</div>
<?php
if (isset($_POST['cours'])) {
    try {
        if (empty($_POST['cours'])) {
            throw new RuntimeException('Veuillez remplir toutes les valeurs.');
        } else {
            delCours($_POST['cours']);
        }
    } catch (RuntimeException $e) {
        echo '<script>alert("' . $e->getMessage() . '");</script>';
    }
}