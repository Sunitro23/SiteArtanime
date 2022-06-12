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
        echo '<script>alert("Login ou Mot de passe.");</script>';
    }
}

//All Gets
function getActivites() {
    $connexion = connect();
    $requete = "SELECT activites.idActivites,titre,description,imgName FROM activites INNER JOIN imageactivite ON activites.idActivites = imageactivite.idActivites";
    $query = $connexion->prepare($requete);
    $execute = $query->execute();
    $LesActivites = $query->fetchAll();
    return $LesActivites;
}

function getLesEvent() {
    $connexion = connect();
    $requete = "SELECT evenements.idEvent,titre,description,addresse,date,horaires,imgName FROM evenements INNER JOIN imageevent ON evenements.idEvent = imageevent.idEvent";
    $query = $connexion->prepare($requete);
    $execute = $query->execute();
    $LesEvent = $query->fetchAll();
    return $LesEvent;
}

function getDetailAct($id) {
    $connexion = connect();
    $requete = "SELECT activites.idActivites,titre,description,imgName FROM activites INNER JOIN imageactivite ON activites.idActivites = imageactivite.idActivites WHERE activites.idActivites = :id";
    $query = $connexion->prepare($requete);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $execute = $query->execute();
    $UneActivite = $query->fetch();
    return $UneActivite;
}

function getAnim() {
    $connexion = connect();
    $requete = "SELECT nom,prenom,description,imgAnim,idAnim FROM animateurs";
    $query = $connexion->prepare($requete);
    $execute = $query->execute();
    $LesAnimateurs = $query->fetchAll();
    return $LesAnimateurs;
}

function getCA() {
    $connexion = connect();
    $requete = "SELECT * FROM conseiladmin";
    $query = $connexion->prepare($requete);
    $execute = $query->execute();
    $LeCA = $query->fetchAll();
    return $LeCA;
}

function getCloseEvent() {
    $connexion = connect();
    $requete = "SELECT evenements.idEvent,titre,description,addresse,date,horaires,imgName FROM evenements INNER JOIN imageevent ON evenements.idEvent = imageevent.idEvent ORDER BY ABS(date - CURRENT_DATE()) ASC LIMIT 1;";
    $query = $connexion->prepare($requete);
    $query->execute();
    $newEvent = $query->fetch();
    return $newEvent;
}

//All Add
function addActivites($titre, $description, $filename) {
    $connexion = connect();
    $query = $connexion->prepare('INSERT INTO activites(titre,description) VALUES(:titre,:description);');
    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $execute = $query->execute();
    $query2 = $connexion->prepare('INSERT INTO imageactivite(imgName,idActivites) VALUES(:imgName ,(SELECT MAX(idActivites) FROM activites));');
    $query2->bindValue(':imgName', $filename, PDO::PARAM_STR);
    $execute2 = $query2->execute();
    if ($execute && $execute2) {
        echo '<script>alert("Activitée crée avec succès.");</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

function addEvent($titre, $date, $horaires, $addresse, $description, $filename) {
    $connexion = connect();
    $query = $connexion->prepare('INSERT INTO evenements(titre,description,date,addresse,horaires) VALUES(:titre,:description,:date,:addresse,:horaires)');
    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':date', $date, PDO::PARAM_STR);
    $query->bindValue(':horaires', $horaires, PDO::PARAM_STR);
    $query->bindValue(':addresse', $addresse, PDO::PARAM_STR);
    $execute = $query->execute();
    $query2 = $connexion->prepare('INSERT INTO imageevent(imgName,idEvent) VALUES(:imgName ,(SELECT MAX(idEvent) FROM evenements));');
    $query2->bindValue(':imgName', $filename, PDO::PARAM_STR);
    $execute2 = $query2->execute();
    if ($execute && $execute2) {
        echo '<script>alert("Évenement crée avec succès.");</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

function addAnimateur($nom, $prenom, $description, $filename) {
    $connexion = connect();
    $query = $connexion->prepare('INSERT INTO animateurs(nom,prenom,description,imgAnim) VALUES(:nom,:prenom,:description,:img)');
    $query->bindValue(':nom', $nom, PDO::PARAM_STR);
    $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':img', $filename, PDO::PARAM_STR);
    $execute = $query->execute();
    if ($execute) {
        echo '<script>alert("Animateur crée avec succès.");</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

function addCA($nom, $prenom, $fonction, $filename) {
    $connexion = connect();
    $query = $connexion->prepare('INSERT INTO conseiladmin(nom,prenom,imgCA,fonction) VALUES(:nom,:prenom,:img,:fonction)');
    $query->bindValue(':nom', $nom, PDO::PARAM_STR);
    $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $query->bindValue(':fonction', $fonction, PDO::PARAM_STR);
    $query->bindValue(':img', $filename, PDO::PARAM_STR);
    $execute = $query->execute();
    if ($execute) {
        echo '<script>alert("Membre du CA crée avec succès.");</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

//All Dels

function delActivite($id) {
    $connexion = connect();
    $requete = "DELETE FROM activites WHERE idActivites = :id;";
    $query = $connexion->prepare($requete);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $execute = $query->execute();
    $query2 = $connexion->prepare("DELETE FROM imageactivite WHERE idActivites = :id;");
    $query2->bindValue(':id', $id, PDO::PARAM_STR);
    $execute2 = $query2->execute();
    if ($execute & $execute2) {
        echo '<script>alert("Supprimé avec succès");</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

function delEvent($id) {
    $connexion = connect();
    $requete = "DELETE FROM evenements WHERE idEvent = :id;";
    $query = $connexion->prepare($requete);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $execute = $query->execute();
    $query2 = $connexion->prepare("DELETE FROM imageevent WHERE idEvent = :id;");
    $query2->bindValue(':id', $id, PDO::PARAM_STR);
    $execute2 = $query2->execute();
    if ($execute & $execute2) {
        echo '<script>alert("Supprimé avec succès");</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

function delAnim($id) {
    $connexion = connect();
    $requete = "DELETE FROM animateurs WHERE idAnim = :id ;";
    $query = $connexion->prepare($requete);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $execute = $query->execute();
    if ($execute) {
        echo '<script>alert("Supprimé avec succès");</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

function delCA($id) {
    $connexion = connect();
    $requete = "DELETE FROM conseiladmin WHERE idCA = :id ;";
    $query = $connexion->prepare($requete);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $execute = $query->execute();
    if ($execute) {
        echo '<script>alert("Supprimé avec succès");</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}
