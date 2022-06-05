<?php include_once '../inc/header.inc'; ?>

<div class='subpart'><h2>Quels sont nos activités ?</h2></div><br>
<div class="subpart" style="background-color:transparent;flex-wrap:wrap;display: flex;box-shadow: none;">
    <?php
    include_once '../bdd/fonctionsBDD.php';
    $LesActivites = getActivites();
    foreach ($LesActivites as $UneActivite) {
        echo '
    <div class="container">
    
        <form id="'.$UneActivite['idActivites'].'" name="'.$UneActivite['idActivites'].'" method="POST">
        
            <input type = "hidden" id="id" name="id" value = "' . $UneActivite['idActivites'] . '" />
                
            <a href="#" onclick="document.getElementById(`'.$UneActivite['idActivites'].'`).submit();" class="button">
                
                <div class="subpart" style="height:300px;"> 

                    <div class="crop activite-img" style="height:70%;">
                
                        <img src=../img/act/' . $UneActivite['imgName'] . ' alt ="' . $UneActivite['imgName'] . '" style="min-width:100%;min-height:100%;">
                
                    </div>          
            
                    <h3>' . $UneActivite['titre'] . '</h3>
                    
                </div>
            
            </a>
            
        </form>
        
    </div>';
    }
    ?>
</div>
<div class="bg-modal">  

    <div class="subpart modal" style="display: inline;">

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
            echo '
            <script type="text/javascript"> showAct(); </script>
            
            <div class="crop" style="width=100%;height:200px; margin-top:30px;">
            
                <img src="../img/act/' . $UneActivite['imgName'] . '" alt="' . $UneActivite['imgName'] . ' style="min-width:100%;min-height:100%;"">
            
            </div>
            
            <h1><ins>' . $UneActivite['titre'] . '</ins></h1>
                
            <p>' . $UneActivite['description'] . '</p>';
        }
        unset($_POST['id']);    
        ?>

    </div>

</div>
<?php
include_once '../inc/footer.inc';
