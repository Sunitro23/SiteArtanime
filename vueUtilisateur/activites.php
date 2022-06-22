<?php
include_once '../inc/header.inc';
include_once '../bdd/fonctionsBDD.php';
?>

<div class='subpart'><h2>Quels sont nos activités ?</h2></div><br>

<div class="subpart" id="activites-flex">
    <?php
    $LesActivites = getActivites();
    foreach ($LesActivites as $UneActivite) {

        //Selection Activitées
        echo '
    <div class="container zoom">
    
        <form id="' . $UneActivite['idActivites'] . '" name="' . $UneActivite['idActivites'] . '" method="POST">
        
            <input type = "hidden" id="id" name="id" value = "' . $UneActivite['idActivites'] . '" />
                
            <a href="#" onclick="document.getElementById(`' . $UneActivite['idActivites'] . '`).submit();" class="button">
                
                <div class="subpart transparent-container activite-container" style="height:250px;">
                
                    <img src="../img/act/' . $UneActivite["imgName"] . '" style="object-fit:cover;min-width:100%;min-height:100%;">
                        
                </div>
                <div class="tag" style="background:' . $UneActivite["color"] . ';">
                    <p style="mix-blend-mode: difference;">' . $UneActivite["titre"] . '</p>
                </div>
            </a>
        </form>';
        if (isset($_SESSION['login'])) {

            //ICONE SUPPRIMER ACTIVITES

            echo '
            <form id="del' . $UneActivite['idActivites'] . '" name="del' . $UneActivite['idActivites'] . '" method="POST">
                
                <input type = "hidden" id="delid" name="delid" value = "' . $UneActivite['idActivites'] . '" />
                    
                <a href="#" onclick="document.getElementById(`del' . $UneActivite['idActivites'] . '`).submit();" class="button">
                
                    <i class="fa fa-trash" style="position:relative; float:right; bottom: 30px;right: 50px;"></i>
            
                </a>
            
            </form>';
        }
        echo '</div>';
    }
    ?>
</div>

<div class="bg-modal">  

    <div class="modal">

        <div class="close">+</div>

        <?php
        //Suppression
        if (isset($_POST['delid']) && !empty($_POST['delid'])) {
            delActivite($_POST['delid']);
        }

        //Scripts
        include_once '../inc/scriptAct.inc';

        //Affichage Détail Activité

        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $UneActivite = getDetailAct($_POST['id']);
            echo '
            <script type="text/javascript"> showAct(); </script>
            
            <div class="subpart transparent-container activite-container" style="height:200px;box-shadow:none;">
            
                <img src="../img/act/' . $UneActivite['imgName'] . '" alt="' . $UneActivite['imgName'] . '" style="object-fit:cover;height:100%;width:100%;">
            
            </div>
            
            <h1><ins>' . $UneActivite['titre'] . '</ins></h1>
                
            <p>' . $UneActivite['description'] . '</p>';
        }

        //Affichage Détail Cours
        if (isset($_POST['idCours'])) {
            $UnCours = getDetailCours($_POST['idCours']);
            echo '
            <script>showAct();</script>
            
            <h1><ins>' . $UnCours['titre'] . '</ins></h1>
                
            <div id="act-calendar">
            
            <div style="width: calc(100% - 250px);display:inline;">
                <p style="margin:0">Quand ?</p>
                <p>De ' . $UnCours['heureDebut'] . 'h à ' . $UnCours['heureFin'] . 'h</p>
                <p>Où ? </p>
                <p>' . $UnCours['addresse'] . '</p>
                <p>Niveau : ' . $UnCours['niveau'] . '</p>
            </div>
            
            <div class="container-photo" style="display: block;width: 250px;">
                <h3 style="margin:0;">Avec :</h3>
                <div class = "subpart transparent-container activite-container" style = "height:150px;width:150px;box-shadow:none;">

                    <img src = "../img/anim/' . $UnCours['imgAnim'] . '" alt = "' . $UnCours['imgAnim'] . '" style = "object-fit:cover;height:100%;width:100%;">
            
                </div>
            
                <h2>' . $UnCours['nom'] . ' ' . $UnCours['prenom'] . '</h2>
            </div>
            
            </div>';
        }
        ?>

    </div>

</div><br>

<!--PLANNING-->

<div class="subpart">
    <div id='calendar'></div>
</div><br><br>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>