<?php include_once './inc/header.inc';?>

<div class="subpart"><h2>Prochain Évenements !</h2></div><br>

<div class="subpart">
<?php
include_once './bdd/fonctionsBDD.php';
$newEvent = getCloseEvent();
echo '<h2>'.$newEvent['titre'].'</h2>
      <img src="./img/event/'.$newEvent['imgName'].'" alt="'.$newEvent['imgName'].'">';
?>
</div><br>

<div class='subpart'><h2>Qu'est ce qu'Artanime ?</h2></div><br>

<div class='subpart'>

    <img class='logo container-photo right' src="img/womandancin.png" style="height: 15%; width: 15%">

    <p>Artanime a été créée en 1994 par André NOWAK et Myriam CALVANUS son épouse. Fort de ses 310 adhérents en 2017, cette association se place, en matière d’effectifs, parmi les associations les plus dynamiques de LEERS.<br>
        Elle a mis en place depuis bientôt 25 ans des ateliers divers tel que : la danse (Funky, Modern’Jazz, Oriental, R’N’B, bollywood…), la musique (batterie, guitare classique, électrique, piano ) et arts plastiques qui regroupent environ 250 élèves.<br>
        Les effectifs d’ArtAnime ont décuplé en 10 ans !<br>
        Plus de 30 ateliers, près de 20 animateurs encadrent tout ce monde à LEERS. L’essentiel des adhérents est leersois. Plus de 30 bénévoles, techniciens,… qui, dans l’ombre, font que cette association perdure. Cette association artistique obtient très vite une renommée métropolitaine en répondant à l’invitation de villes ou d’associations régionales.<br>
        Si vous avez envie de vivre des sensations fortes en rythme, n’hésitez pas, visitez la suite du site, venez-nous rendre visite lors de nos évènements ou inscrivez-vous !</p>

    <video controls><source src="video/VideoArtanime.mp4" type="video/mp4">Votre navigateur ne peut pas lancer des vidéos.</video>

</div>

<?php
include_once 'inc/footer.inc';
