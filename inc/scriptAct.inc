<script>
    function showAct() {
        document.querySelector('.bg-modal').style.display = "flex";
    }
    document.querySelector('.close').addEventListener('click', function () {
        document.querySelector('.bg-modal').style.display = 'none';
        window.location.href = window.location.href;
    });
    function form(id) {
        document.open();
        document.write("<form id='" + id + "' name='" + id + "' method='POST'><input type = 'hidden' id='idCours' name='idCours' value = '" + id + "'></form>");
        document.close();
    }
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            eventClick: function (info) {
                var eventObj = info.event;
                form(eventObj.id);
                document.getElementById(eventObj.id).submit();
            }
            ,
            initialView: 'timeGridWeek',
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
            firstDay: 1,
            contentHeight: 'auto',
            slotDuration: '1:00',
            slotMaxTime: "24:00:00",
            slotMinTime: "06:00:00",
            locale: 'fr',
            allDaySlot: false,
            displayEventTime: false,
            events: [

<?php
$LesCours = getLesCours();
foreach ($LesCours as $UnCours) {
    echo"{
                id:'" . $UnCours['idCours'] . "',
                groupId: '" . $UnCours['idActivites'] . "',
                title: '" . $UnCours['titre'] . "',
                daysOfWeek: ['" . $UnCours['jour'] . "'],
                startTime: '" . $UnCours['heureDebut'] . "',
                endTime: '" . $UnCours['heureFin'] . "',
                backgroundColor:'" . $UnCours['color'] . "'},";
}
?>

            ]
        });
        calendar.render();
    });
</script>