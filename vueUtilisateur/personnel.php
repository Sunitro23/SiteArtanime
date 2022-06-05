<?php
include_once '../inc/header.inc';
include_once '../bdd/fonctionsBDD.php';
?>
<div class='subpart'><h2>Qui sont nos Animateurs ?</h2></div><br>
<?php
$LesAnim = getAnim();
$placement = 0;
foreach ($LesAnim as $UnAnim) {

    echo'<div class="subpart" style="display: inline-block;">
                    
            <div id="' . $placement . '" class="container-photo ">
                
                <div class="crop" style="height:200px; width:200px;">
                
                     <img src=../img/anim/' . $UnAnim['imgAnim'] . ' alt ="' . $UnAnim['prenom'] . '" style="min-width:100%;min-height:100%;">
                        
                </div>  
                
                <h2 class="name">' . $UnAnim['prenom'] . ' ' . $UnAnim['nom'] . '</h2>     
                    
            </div>
     
            <p>' . $UnAnim['description'] . '</p>
                    
        </div><br><br>';

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
