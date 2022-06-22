<?php
include_once '../inc/header.inc';
include_once '../bdd/fonctionsBDD.php';
if (isset($_POST['delid']) && !empty($_POST['delid'])) {
    delEvent($_POST['delid']);
}
?>

<div class='subpart'><h2>Quels sont nos activités ?</h2></div><br>

<div class="subpart transparent-container " id="event-flex">

    <?php
    $LesEvent = getLesEvent();
    foreach ($LesEvent as $UnEvent) {
        echo '
    <div class="subpart event">
    
        <div class="event-container">
        
            <img src="../img/event/' . $UnEvent['imgName'] . '" alt="' . $UnEvent['imgName'] . '" style="object-fit:cover;min-width:100%;min-height:100%;">
            
        </div>
        
        <h1 style="text-align: left;color:var(--text-light);">' . $UnEvent['titre'] . '</h1>
                
        <p>' . $UnEvent['description'] . '<br>' . $UnEvent['addresse'] . '<br>' . date($UnEvent['date']) . ' ' . $UnEvent['horaires'] . '</p>';
        if (isset($_SESSION['login'])) {
            echo '
            <form id="del' . $UnEvent["idEvent"] . '" name="del' . $UnEvent["idEvent"] . '" method="POST">
                
                <input type = "hidden" id="delid" name="delid" value = "' . $UnEvent["idEvent"] . '" />
                    
                <a href="#" onclick="document.getElementById(`del' . $UnEvent["idEvent"] . '`).submit();" class="button">
                
                    <i class="fa fa-trash" style="position:relative; float:right; bottom: 30px;right: 50px;"></i>
            
                </a>
            
            </form>';
        }
        echo '</div>';
    }
    ?>

</div>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
