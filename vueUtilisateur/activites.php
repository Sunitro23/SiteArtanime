<?php
include_once '../inc/header.inc';
include_once '../bdd/fonctionsBDD.php';
if (isset($_POST['delid']) && !empty($_POST['delid'])) {
    delActivite($_POST['delid']);
}
?>

<div class='subpart'><h2>Quels sont nos activités ?</h2></div><br>

<div class="subpart" id="activites-flex">
    <?php
    $LesActivites = getActivites();
    foreach ($LesActivites as $UneActivite) {
        echo '
    <div class="container zoom">
    
        <form id="' . $UneActivite['idActivites'] . '" name="' . $UneActivite['idActivites'] . '" method="POST">
        
            <input type = "hidden" id="id" name="id" value = "' . $UneActivite['idActivites'] . '" />
                
            <a href="#" onclick="document.getElementById(`' . $UneActivite['idActivites'] . '`).submit();" class="button">
                
                <div class="subpart transparent-container activite-container" style="height:250px;">
                
                    <img src="../img/act/' . $UneActivite["imgName"] . '" style="object-fit:cover;min-width:100%;min-height:100%;">
                        
                </div>
                <div class="tag">
                    <p>' . $UneActivite["titre"] . '</p>
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

    <div class="subpart modal" style="display: inline;overflow: hidden;">

        <div class="close">+</div>

        <script>
            function showAct() {
                document.querySelector('.bg-modal').style.display = "flex";
            }
            document.querySelector('.close').addEventListener('click', function () {
                document.querySelector('.bg-modal').style.display = 'none';
                window.location.href = window.location.href;
            });
        </script>

        <?php
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
        ?>

    </div>

</div><br>
<!--PLANNING-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            eventClick: function (info) {
                var eventObj = info.event;
                if (eventObj.groupId) {
                    alert('Event Name = ' + eventObj.groupId);
                }
            },
            initialView: 'timeGridWeek',
            hiddenDays: [0],
            headerToolbar: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            slotLabelFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            },
            events: [
                {
<?php
$LesCours = getLesCours();
foreach ($LesCours as $UnCours) {
    echo"
                        groupId: '" . $UnCours['idActivites'] . "',
                        title: '" . $UnCours['titre'] . "',
                        daysOfWeek: ['" . $UnCours['jour'] . "'],
                        startTime: '" . $UnCours['heureDebut'] . ":00',
                        endTime: '" . $UnCours['heureFin'] . ":00'";
}
?>
                }
            ]

        });
        calendar.render();
        calendar.setOption("slotMaxTime", "22:00:00");
        calendar.setOption("slotMinTime", "08:00:00");
        calendar.setOption("locale", "fr");
        calendar.setOption('contentHeight', 'auto');
        calendar.setOption('slotDuration', '1:00');
        calendar.setOption('allDaySlot', false);
        calendar.setOption('displayEventTime', false)
    });
</script>
<div class="subpart">
    <div id='calendar'></div>
</div><br><br>
<?php
include_once '../inc/footer.inc';
