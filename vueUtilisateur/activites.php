<?php
include_once '../inc/header.inc';
include_once '../bdd/fonctionsBDD.php';
?>

<div class='subpart'><h2>Quels sont nos activités ?</h2></div><br>

<?php
$LesActivites = getActivites();
foreach ($LesActivites as $UneActivite) {
    echo '
    <div class="container">
        <form id="formAct" name="formAct" method="POST">
            <input type = "hidden" name = "id" value = "' . $UneActivite['idActivites'] . '" />
            <a href="#" onclick="document.getElementById(`formAct`).submit();" class="button">
            <img class="Down" src=../img/act/' . $UneActivite['imgName'] . ' alt ="' . $UneActivite['altImg'] . '" width="302px" height="150px">
            <div class="subpart Up"> 
                <h3>' . $UneActivite['titre'] . '</h3>
            </div>
            </a>
        </form>
    </div>';
}
?>

<div class="bg-modal">  
    <div class="subpart modal">
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
        if (isset($_POST['id']) && $_POST['id'] != null) {
            $UneActivite = getDetailAct($_POST['id']);
            echo '<script type="text/javascript"> showAct(); </script>
            <div class="imageFull">
                <img src="../img/act/' . $UneActivite['imgName'] . '" alt="' . $UneActivite['altImg'] . ' height="400px" width="800px">
            </div>
            <h1><ins>' . $UneActivite['titre'] . '</ins></h1>
            <p>' . $UneActivite['description'] . '</p>';
        }
        ?>

    </div>
</div>
<?php
include_once '../inc/footer.inc';
