<?php

function connect() {

    try {
        $connect = new PDO('mysql:host=localhost;dbname=artanime;charset=utf8', 'root', '');
    } catch (Exception $e) {
        echo 'Erreur de Connexion : ' . $e->getMessage();
    }
    return $connect;
}

function login($mdp, $login) {
    $connexion = connect();
    $query = $connexion->prepare('SELECT login,mdp FROM admin WHERE login LIKE(:login) AND mdp LIKE(PASSWORD(:mdp))');
    $query->bindValue(':login', $login, PDO::PARAM_STR);
    $query->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    $query->execute();
    $resultats = $query->fetch();
    if ($resultats) {
        $_SESSION['login'] = $login;
        session_id();
        echo '<meta http-equiv="refresh" content="1; url=index.php"/>';
    } else {
        echo '<h1>Login ou Mot de passe incorrect</h1>';
    }
}

//All Gets
function getActivites() {
    $connexion = connect();
    $requete = "SELECT activites.idActivites,titre,description,imgName,altImg FROM activites INNER JOIN imageactivite ON activites.idActivites = imageactivite.idActivites";
    $query = $connexion->prepare($requete);
    $execute = $query->execute();
    $LesActivites = $query->fetchAll();
    return $LesActivites;
}

function getDetailAct($id) {
    $connexion = connect();
    $requete = "SELECT activites.idActivites,titre,description,imgName,altImg FROM activites INNER JOIN imageactivite ON activites.idActivites = imageactivite.idActivites WHERE activites.idActivites = :id";
    $query = $connexion->prepare($requete);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $execute = $query->execute();
    $UneActivite = $query->fetch();
    return $UneActivite;
}

function getAnim() {
    $connexion = connect();
    $requete = "SELECT nom,prenom,description,imgAnim FROM animateurs";
    $query = $connexion->prepare($requete);
    $execute = $query->execute();
    $LesAnimateurs = $query->fetchAll();
    return $LesAnimateurs;
}

//All Add
function addActivites($titre, $description) {
    $connexion = connect();
    $query = $connexion->prepare('INSERT INTO activites(titre,description) VALUES(:titre,:description)');
    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $execute = $query->execute();
    if ($execute) {
        echo "<div class='subpart'><h2>L'activitée à été créée</h2></div><br>";
    } else {
        echo "<h2> /!\ Erreur sur le titre ou la description </h2>";
    }
}

function addImgActivites($titre, $description, $filename, $altname) {
    $connexion = connect();
    //Requete sur l'id
    $getId = $connexion->prepare('SELECT idActivites FROM activites WHERE titre = :titre AND description = :description');
    $getId->bindValue(':titre', $titre, PDO::PARAM_STR);
    $getId->bindValue(':description', $description, PDO::PARAM_STR);
    $getId->execute();
    $id = $getId->fetch();
    //Requete Principale
    $query = $connexion->prepare('INSERT INTO imageactivite(imgName,altImg,idActivites) VALUES(:filename,:altname,:id)');
    $query->bindValue(':id', $id['idActivites'], PDO::PARAM_INT);
    $query->bindValue(':filename', $filename, PDO::PARAM_STR);
    $query->bindValue(':altname', $altname, PDO::PARAM_STR);
    $execute = $query->execute();
    if (!$execute) {
        echo "<div class='subpart'><h2> /!\ Erreur sur l'image </h2></div><br>";
    }
}

function addAnimateur($nom,$prenom,$description,$filename) {
    $connexion = connect();
    $query = $connexion->prepare('INSERT INTO animateurs(nom,prenom,description,imgAnim) VALUES(:nom,:prenom,:description,:img)');
    $query->bindValue(':nom', $nom, PDO::PARAM_STR);
    $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':img', $filename, PDO::PARAM_STR);
    $execute = $query->execute();
    if ($execute) {
        echo "<div class='subpart'><h2>L'animateur à été ajouté</h2></div><br>";
    } else {
        echo "<h2> /!\ Erreur </h2>";
    }
}
