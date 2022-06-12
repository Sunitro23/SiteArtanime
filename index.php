<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v14.0" nonce="JKNpoSlB"></script>

<?php include_once './inc/header.inc'; ?>

<div id="index-container" class="subpart transparent-container">

    <div class="index subpart">

        <h2>Prochain Évenement !</h2>

        <?php
        include_once './bdd/fonctionsBDD.php';
        $newEvent = getCloseEvent();
        echo'<div class="crop"><img src="./img/event/' . $newEvent['imgName'] . '" alt="' . $newEvent['imgName'] . '" style="object-fit:cover; min-width:100%; min-height:100%;"></div>';
        ?>

    </div>

    <div class="index subpart">

        <h2>Actualitée</h2>
        <div class="fb-page" data-href="https://www.facebook.com/artanimeleers" data-tabs="timeline" data-width="555" data-height="700px" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"><blockquote cite="https://www.facebook.com/artanimeleers" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/artanimeleers">Artanime Leers</a></blockquote></div>
    </div>
</div>
<br>

<div id="right" class='subpart'><h2>Qu'est ce qu'Artanime ?</h2></div><br>

<div class='subpart'>

    <img class='logo container-photo right' src="img/womandancin.png" style="height: 15%; width: 15%">

    <p>Artanime a été créée en 1994 par André NOWAK et Myriam CALVANUS son épouse. Fort de ses 310 adhérents en 2017, cette association se place, en matière d’effectifs, parmi les associations les plus dynamiques de LEERS.<br>
        Elle a mis en place depuis bientôt 25 ans des ateliers divers tel que : la danse (Funky, Modern’Jazz, Oriental, R’N’B, bollywood…), la musique (batterie, guitare classique, électrique, piano ) et arts plastiques qui regroupent environ 250 élèves.<br>
        Les effectifs d’ArtAnime ont décuplé en 10 ans !<br>
        Plus de 30 ateliers, près de 20 animateurs encadrent tout ce monde à LEERS. L’essentiel des adhérents est leersois. Plus de 30 bénévoles, techniciens,… qui, dans l’ombre, font que cette association perdure. Cette association artistique obtient très vite une renommée métropolitaine en répondant à l’invitation de villes ou d’associations régionales.<br>
        Si vous avez envie de vivre des sensations fortes en rythme, n’hésitez pas, visitez la suite du site, venez-nous rendre visite lors de nos évènements ou inscrivez-vous !</p>

    <video style="height: auto;" controls><source src="video/VideoArtanime.mp4" type="video/mp4">Votre navigateur ne peut pas lancer des vidéos.</video>

</div>

<?php
include_once 'inc/footer.inc';
