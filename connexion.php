<?php
session_start();
include("librairies/fonctions.lib.php");
$bd = null;
ConnecterBd($bd);
// INITIALISER LA CONNEXION À FAUX
$isConnected = false;
// VERIFICATION SI IL Y A UNE ACTION
if(isset($_GET["action"])){
    // VERIFICATION ACTION CONNECTER
    if($_GET["action"] == "connecter"){
        $message = ConnecterUsager($bd, $_POST['courriel'], $_POST['mdp']);

        if(!isset($message))
            $isConnected = true;
        else
            $isConnected = false;
    }
    // VERIFICATION ACTION DECONNECTER
    else if($_GET["action"] == "deconnecter") {
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
if(!empty($message)) echo $message;
include("inclus/piedPage.inc.php");
?>