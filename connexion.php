<?php
// DEMARRER LES SESSIONS
session_start();
// INCLURE LES FONCTIONS PHP
include("librairies/fonctions.lib.php");
// CONNECTER BD
$bd;
ConnecterBd($bd);
// INITIALISER LA CONNEXION À FAUX
$isConnected = false;
// VERIFICATION ACTION
if(isset($_GET["action"])){
    if($_GET["action"] == "connecter"){
        $message = ConnecterUsager($bd, $_POST['courriel'], $_POST['mdp']);

        if(!isset($message))
            $isConnected = true;
        else
            $isConnected = false;
    }
}
// VERIFICATION CONNEXION
if($isConnected){
    $_SESSION['isConnected'] = true;
    header("Location:index.php");
}
else{
    $_SESSION['isConnected'] = false;
}
// INCLURE L'ENTETE
include("inclus/entete.inc.php");
?>
<!-- CONNEXION -->
<h2 class="mb-4">Connexion</h2>
<form action="connexion.php?action=connecter" name="formConnexion" method="post">
    <fieldset>
        <p>Courriel : </p>
        <input type="text" name="courriel">
        <p>Mot de passe : </p>
        <input type="password" name="mdp">
    </fieldset>
    <fieldset>
        <input type="submit" value="SE CONNECTER">
        <input type="reset" value="ANNULER">
        <p id="erreur"></p>
        <p id="reserve">* Cette section est réservée à l'administation</p>
    </fieldset>
</form>
<?php
// AFFICHER LE MESSAGE ERREUR
if(!empty($message)) echo $message;
// INCLURE LE PIED DE PAGE
include("inclus/piedPage.inc.php");
?>