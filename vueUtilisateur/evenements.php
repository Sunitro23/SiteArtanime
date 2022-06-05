<?php

include_once '../inc/header.inc';
include_once '../BDD/fonctionsBDD.php';
$LesEvent = getLesEvent();
foreach ($LesEvent as $UnEvent) {
    echo '
    <div class="subpart">
    
            <div class="crop container-photo left" style="width:350px;height:390px;">
            
                <img src="../img/event/' . $UnEvent['imgName'] . '" alt="' . $UnEvent['imgName'] . '">
                    
            </div>
                <h1 style="font-weight: bold;">' . $UnEvent['titre'] . '</h1>
                <p>' . $UnEvent['description'] . '</p>
                <p>' . $UnEvent['addresse'] . '</p>
                <p>' . $UnEvent['date'] . '</p>
                <p>' . $UnEvent['horaires'] . '</p>

    </div>';
}