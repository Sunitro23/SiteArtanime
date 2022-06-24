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
    //Connection
    $connexion = connect();

    //Requetes
    $requete = 'SELECT login,mdp FROM admin WHERE login LIKE(:login) AND mdp LIKE(PASSWORD(:mdp))';

    //Login
    $query = $connexion->prepare($requete);
    $query->bindValue(':login', $login, PDO::PARAM_STR);
    $query->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    $query->execute();
    $resultats = $query->fetch();

    //Verif
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
    //Connection
    $connexion = connect();

    //Requetes
    $requete = "SELECT activites.idActivites,titre,description,imgName,color FROM activites INNER JOIN imageactivite ON activites.idActivites = imageactivite.idActivites";

    //Get Activites
    $query = $connexion->prepare($requete);
    $query->execute();
    $LesActivites = $query->fetchAll();

    //Return
    return $LesActivites;
}

function getLesEvent() {
    //Connection
    $connexion = connect();

    //Requetes
    $requete = "SELECT evenements.idEvent,titre,description,addresse,date,horaires,imgName FROM evenements INNER JOIN imageevent ON evenements.idEvent = imageevent.idEvent";

    //Get Evenements
    $query = $connexion->prepare($requete);
    $query->execute();
    $LesEvent = $query->fetchAll();

    //Return
    return $LesEvent;
}

function getDetailAct($id) {
    //Connection
    $connexion = connect();

    //Requetes
    $requete = "SELECT activites.idActivites,titre,description,imgName,color FROM activites INNER JOIN imageactivite ON activites.idActivites = imageactivite.idActivites WHERE activites.idActivites = :id";

    //Get le Detail d'une Activite
    $query = $connexion->prepare($requete);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $UneActivite = $query->fetch();

    //Return
    return $UneActivite;
}

function getAnim() {
    //Connection
    $connexion = connect();

    //Requetes
    $requete = "SELECT nom,prenom,description,imgAnim,idAnim FROM animateurs";

    //Get les Animateurs
    $query = $connexion->prepare($requete);
    $query->execute();
    $LesAnimateurs = $query->fetchAll();

    //Return
    return $LesAnimateurs;
}

function getCA() {
    //Connection
    $connexion = connect();

    //Requetes
    $requete = "SELECT * FROM conseiladmin";

    //Get le Conseil Administratif
    $query = $connexion->prepare($requete);
    $query->execute();
    $LeCA = $query->fetchAll();

    //Return
    return $LeCA;
}

function getCloseEvent() {
    //Connection
    $connexion = connect();

    //Requetes
    $requete = "SELECT evenements.idEvent,titre,description,addresse,date,horaires,imgName FROM evenements INNER JOIN imageevent ON evenements.idEvent = imageevent.idEvent ORDER BY ABS(date - CURRENT_DATE()) ASC LIMIT 1;";

    //Get le plus proche des evenements
    $query = $connexion->prepare($requete);
    $query->execute();
    $newEvent = $query->fetch();

    //Return
    return $newEvent;
}

function getLesCours() {
    //Connection
    $connexion = connect();

    //Requetes
    $requete = "SELECT * FROM cours JOIN activites ON activites.idActivites=cours.idActivites";

    //Get Cours
    $query = $connexion->prepare($requete);
    $query->execute();
    $Cours = $query->fetchAll();

    //Return
    return $Cours;
}

function getDetailCours($id) {
    //Connection
    $connexion = connect();

    //Requetes
    $requete = "SELECT * FROM cours INNER JOIN activites ON cours.idActivites = activites.idActivites INNER JOIN animateurs ON animateurs.idAnim = cours.idAnim WHERE idCours = :id;";

    //Get Detail du Cours
    $query = $connexion->prepare($requete);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $UnCours = $query->fetch();

    //Return
    return $UnCours;
}

function getDay($jour) {
    switch ($jour) {
        case 0: $day = 'dimanche';
            break;
        case 1: $day = 'lundi';
            break;
        case 2: $day = 'mardi';
            break;
        case 3: $day = 'mercredi';
            break;
        case 4: $day = 'jeudi';
            break;
        case 5: $day = 'vendredi';
            break;
        case 6: $day = 'samedi';
            break;
        default: echo "Erreur !";
            break;
    }
    return $day;
}

//ALL ADD

function addActivites($titre, $description, $filename, $color) {
    //Connection
    $connexion = connect();

    //Requetes
    $requete = 'INSERT INTO activites(titre,description,color) VALUES(:titre,:description,:color)';
    $requete2 = 'INSERT INTO imageactivite(imgName,idActivites) VALUES(:imgName ,(SELECT MAX(idActivites) FROM activites))';

    //Add Activite
    $query = $connexion->prepare($requete);
    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':color', $color, PDO::PARAM_STR);
    $execute = $query->execute();

    //Add Images Activite
    $query2 = $connexion->prepare($requete2);
    $query2->bindValue(':imgName', $filename, PDO::PARAM_STR);
    $execute2 = $query2->execute();

    //Verif
    if ($execute && $execute2) {
        echo '<script>alert("Activitée crée avec succès.");</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

function addEvent($titre, $date, $horaires, $addresse, $description, $filename) {
    //Connection
    $connexion = connect();

    //Requete
    $requete = 'INSERT INTO evenements(titre,description,date,addresse,horaires) VALUES(:titre,:description,:date,:addresse,:horaires)';
    $requete2 = 'INSERT INTO imageevent(imgName,idEvent) VALUES(:imgName ,(SELECT MAX(idEvent) FROM evenements))';

    //Add Evenement
    $query = $connexion->prepare($requete);
    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':date', $date, PDO::PARAM_STR);
    $query->bindValue(':horaires', $horaires, PDO::PARAM_STR);
    $query->bindValue(':addresse', $addresse, PDO::PARAM_STR);
    $execute = $query->execute();

    //Add Images Event
    $query2 = $connexion->prepare($requete2);
    $query2->bindValue(':imgName', $filename, PDO::PARAM_STR);
    $execute2 = $query2->execute();

    //Verif
    if ($execute && $execute2) {
        echo '<script>alert("Évenement crée avec succès.");</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

function addAnimateur($nom, $prenom, $description, $filename) {
    //Connection
    $connexion = connect();

    //Requete
    $requete = 'INSERT INTO animateurs(nom,prenom,description,imgAnim) VALUES(:nom,:prenom,:description,:img)';

    //Add Animateurs
    $query = $connexion->prepare($requete);
    $query->bindValue(':nom', $nom, PDO::PARAM_STR);
    $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':img', $filename, PDO::PARAM_STR);
    $execute = $query->execute();

    //Verif
    if ($execute) {
        echo '<script>alert("Animateur crée avec succès.");</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

function addCA($nom, $prenom, $fonction, $filename) {
    //Connection
    $connexion = connect();

    //Requete
    $requete = 'INSERT INTO conseiladmin(nom,prenom,imgCA,fonction) VALUES(:nom,:prenom,:img,:fonction)';

    //AddCA
    $query = $connexion->prepare($requete);
    $query->bindValue(':nom', $nom, PDO::PARAM_STR);
    $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $query->bindValue(':fonction', $fonction, PDO::PARAM_STR);
    $query->bindValue(':img', $filename, PDO::PARAM_STR);
    $execute = $query->execute();

    //Verif
    if ($execute) {
        echo '<script>alert("Membre du CA crée avec succès.");</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

function addCours($day, $hDebut, $hFin, $addresse, $activite, $animateur, $niveau) {
    //Connection
    $connexion = connect();

    //Requete
    $query = $connexion->prepare('INSERT INTO cours(jour,heureDebut,heureFin,idActivites,idAnim,addresse,niveau) VALUES(:day,:hDebut,:hFin,:activite,:animateur,:addresse,:niveau)');
    $query->bindValue(':day', $day, PDO::PARAM_STR);
    $query->bindValue(':hDebut', $hDebut, PDO::PARAM_STR);
    $query->bindValue(':hFin', $hFin, PDO::PARAM_STR);
    $query->bindValue(':activite', $activite, PDO::PARAM_STR);
    $query->bindValue(':animateur', $animateur, PDO::PARAM_STR);
    $query->bindValue(':addresse', $addresse, PDO::PARAM_STR);
    $query->bindValue(':niveau', $niveau, PDO::PARAM_STR);
    $execute = $query->execute();

    //Verif
    if ($execute) {
        echo '<script>alert("Cours ajouté avec succès");</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

//ALL DELS

function delActivite($id) {
    //Connection
    $connexion = connect();

    //Requetes
    $requeteID = "SELECT imgName FROM imageactivite WHERE idActivites = :id";
    $requete = "DELETE FROM activites WHERE idActivites = :id";
    $requete2 = "DELETE FROM imageactivite WHERE idActivites = :id";

    //Remove Image
    $queryID = $connexion->prepare($requeteID);
    $queryID->bindValue(':id', $id, PDO::PARAM_STR);
    $queryID->execute();
    $ImgName = $queryID->fetch();
    unlink("../img/act/" . $ImgName['imgName']);

    //Remove Activite
    $query = $connexion->prepare($requete);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $execute = $query->execute();

    //Remove Image in BDD
    $query2 = $connexion->prepare($requete2);
    $query2->bindValue(':id', $id, PDO::PARAM_STR);
    $execute2 = $query2->execute();

    //Verif
    if ($execute & $execute2) {
        unset($_POST['delid']);
        echo '<script>if(!alert("Supprimé !")){window.location.href = window.location.href;}</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

function delEvent($id) {
    //Connection
    $connexion = connect();

    //Requetes
    $requeteID = "SELECT imgName FROM imageevent WHERE idEvent = :id";
    $requete = "DELETE FROM evenements WHERE idEvent = :id;";
    $requete2 = "DELETE FROM imageevent WHERE idEvent = :id;";

    //Remove Image
    $queryID = $connexion->prepare($requeteID);
    $queryID->bindValue(':id', $id, PDO::PARAM_STR);
    $queryID->execute();
    $ImgName = $queryID->fetch();
    unlink('../img/event/' . $ImgName['imgName']);

    //Remove Activite
    $query = $connexion->prepare($requete);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $execute = $query->execute();

    //Remove Image in BDD
    $query2 = $connexion->prepare($requete2);
    $query2->bindValue(':id', $id, PDO::PARAM_STR);
    $execute2 = $query2->execute();

    //Verif
    if ($execute & $execute2) {
        unset($_POST['delid']);
        echo '<script>if(!alert("Supprimé !")){window.location.href = window.location.href;}</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

function delAnim($id) {
    //Connection
    $connexion = connect();

    //Requete
    $requeteID = "SELECT imgAnim FROM animateurs WHERE idAnim = :id";
    $requete = "DELETE FROM animateurs WHERE idAnim = :id";

    //Remove Image
    $queryID = $connexion->prepare($requeteID);
    $queryID->bindValue(':id', $id, PDO::PARAM_STR);
    $queryID->execute();
    $ImgName = $queryID->fetch();
    unlink('../img/anim/' . $ImgName['imgAnim']);

    //Remove
    $query = $connexion->prepare($requete);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $execute = $query->execute();

    //Verif
    if ($execute) {
        unset($_POST['delid']);
        echo '<script>if(!alert("Supprimé !")){window.location.href = window.location.href;}</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

function delCA($id) {
    //Connection
    $connexion = connect();

    //Requete
    $requete = "DELETE FROM conseiladmin WHERE idCA = :id ;";
    $requeteID = "SELECT imgCA FROM conseiladmin WHERE idCA = :id";

    //Remove Image
    $queryID = $connexion->prepare($requeteID);
    $queryID->bindValue(':id', $id, PDO::PARAM_STR);
    $queryID->execute();
    $ImgName = $queryID->fetch();
    unlink('../img/ca/' . $ImgName['imgCA']);

    //Remove Conseil Admin
    $query = $connexion->prepare($requete);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $execute = $query->execute();

    //Verif
    if ($execute) {
        unset($_POST['delid']);
        echo '<script>if(!alert("Supprimé !")){window.location.href = window.location.href;}</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}

function delCours($cours) {
    //Connection
    $connexion = connect();

    //Requete
    $requete = "DELETE FROM cours WHERE idCours = :id ;";

    //Remove Cours
    $query = $connexion->prepare($requete);
    $query->bindValue(':id', $cours, PDO::PARAM_INT);
    $execute = $query->execute();
    
    if ($execute) {
        echo '<script>alert("Supprimé !")</script>';
    } else {
        echo '<script>alert("Erreur Interne.");</script>';
    }
}
