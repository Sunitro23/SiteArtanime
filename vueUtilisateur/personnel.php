<?php
include_once '../inc/header.inc';
include_once '../bdd/fonctionsBDD.php';

//Suppression des infos CA
if (isset($_POST['delidCA']) && !empty($_POST['delidCA'])) {
    delCA($_POST['delidCA']);
}

//Suppression des infos animateurs
if (isset($_POST['delidAnim']) && !empty($_POST['delidAnim'])) {
    delAnim($_POST['delidAnim']);
}
?>

<!-- CA -->

<div class='subpart'><h2>Le CA </h2></div><br>

<div class="subpart" >

    <?php
    $LeCA = getCA();
    foreach ($LeCA as $UnCA) {
        if ($UnCA['fonction'] == "Président") {
            echo'<div class="container-photo" style="margin-left:auto;margin-right:auto;display: block;padding-top:15px;">';
        } else {
            echo'<div class="container container-photo" style="width:calc(50% - 10px);height:auto;margin:0;padding-bottom:15px;">';
        }

        echo '<div style="height:200px; width:200px;margin-left:auto;margin-right:auto;position:relative;overflow: hidden; border-radius: 10px;">';

        //ICONE SUPPRIMER CA

        if (isset($_SESSION['login'])) {
            echo '
                <form id = "del' . $UnCA['idCA'] . '" name = "del' . $UnCA['idCA'] . '" method = "POST">

                    <input type = "hidden" id = "delidCA" name = "delidCA" value = "' . $UnCA['idCA'] . '" />

                    <a href = "#" onclick = "document.getElementById(`del' . $UnCA['idCA'] . '`).submit();" class = "button">

                        <i class = "fa fa-trash" style = "position:absolute;z-index: 9;padding:2px;"></i>

                    </a>

                </form > ';
        }

        //INFOS CA

        echo'<img src=../img/CA/' . $UnCA['imgCA'] . ' alt ="' . $UnCA['prenom'] . '" style="min-width:100%;min-height:100%;">
        </div>
        
        <h2 class = "name" style = "color:var(--text-light);font-size:1.5em;">' . $UnCA['prenom'] . ' ' . $UnCA['nom'] . '</h2>
            
        <h3 style="margin:0;font-size:1.3em; ">' . $UnCA['fonction'] . '</h3>
            
        </div>';
    }
    ?>
</div><br><br>
<!-- ANIMATEURS -->

<div class='subpart'><h2>Qui sont nos Animateurs ?</h2></div><br>

<?php
$LesAnim = getAnim();
$placement = 0;
foreach ($LesAnim as $UnAnim) {

    echo'<div class="subpart">
                    
            <div id="' . $placement . '" class="container-photo ">
                
                <div style="height:200px; width:200px;margin-left: 35px;margin-right: 35px;position:relative;overflow: hidden; border-radius: 10px;">';

    //ICONE SUPPRIMER ANIMATEUR

    if (isset($_SESSION['login'])) {
        echo '
                <form id = "del' . $UnAnim['idAnim'] . '" name = "del' . $UnAnim['idAnim'] . '" method = "POST">

                    <input type = "hidden" id = "delidAnim" name = "delidAnim" value = "' . $UnAnim['idAnim'] . '" />

                    <a href = "#" onclick = "document.getElementById(`del' . $UnAnim['idAnim'] . '`).submit();" class = "button">

                        <i class = "fa fa-trash" style = "position:absolute;z-index: 9;padding:2px;"></i>

                    </a>

                </form > ';
    }

    //INFOS ANIMATEURS

    echo'<img src=../img/anim/' . $UnAnim['imgAnim'] . ' alt ="' . $UnAnim['prenom'] . '" style="min-width:100%;min-height:100%;">
        </div>
        <h2 class = "name" style = "color:var(--text-light);">' . $UnAnim['prenom'] . ' ' . $UnAnim['nom'] . '</h2>

        </div>

        <p>' . $UnAnim['description'] . '</p>

        </div><br>';

    //PLACEMENT DROITE OU GAUCHE
    if ($placement % 2 == 0) {
        echo '<script>
        var element = document.getElementById("' . $placement . '");
        element.classList.remove("left");
        element.classList.add("right");
        </script>';
    } else {
        echo '<script>
        var element = document.getElementById("' . $placement . '");
        element.classList.remove("right");
        element.classList.add("left");
        </script>';
    }
    $placement += 1;
}
include_once '../inc/footer.inc';
?>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>