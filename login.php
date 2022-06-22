<?php
include_once 'inc/header.inc';
include_once 'bdd/fonctionsBDD.php';
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    login($password, $username);
}
?>
<div class="subpart">
<form action="#" method="post">
    <label for="username">Entrez votre nom d'utilisateur :</label><br>
    <input type="text" name="username" id="username" required><br>
    <label for="password">Entrez votre mot de passe :</label><br>
    <input type="password" name="password" id="password"><br>
    <div class="file"><input type="submit" value="Se connecter"></div>
</form>
</div>
<?php include_once 'inc/footer.inc';