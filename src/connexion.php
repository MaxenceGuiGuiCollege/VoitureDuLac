<?php
session_start();
include("librairies/fonctions.lib.php");
//DEFINIR LA LANGUE
if(isset($_GET['lang']))
    $lang = $_GET['lang'];
else if(isset($_COOKIE['lang']))
    $lang = $_COOKIE['lang'];
else
    $lang = "fr";
setcookie('lang', $lang, time()+365*24*60*60);
$json = obtenirJson($lang);
//DEFINIR LA BD
$bd = null;
ConnecterBd($bd);
// INITIALISER LA CONNEXION À FAUX
$isConnected = false;
// VERIFICATION SI IL Y A UNE ACTION
if(isset($_GET["action"])){
    // VERIFICATION ACTION CONNECTER
    if($_GET["action"] == "connecter"){
        $message = ConnecterUsager($bd, $_POST['courriel'], $_POST['mdp'], $lang);

        if(!isset($message))
            $isConnected = true;
        else
            $isConnected = false;
    }
}
// VERIFICATION CONNEXION
if($isConnected){
    $_SESSION['isConnected'] = true;
    header("Location:ajouterVoiture.php");
}
else{
    $_SESSION['isConnected'] = false;
}
include("inclus/entete.inc.php");
?>
    <!-- CONNEXION -->
    <h2 class="mb-4"><?php echo $json['login_title'] ?></h2>
    <form action="connexion.php?action=connecter" name="formConnexion" method="post">
        <fieldset>
            <p><?php echo $json['login_email'] ?> : </p>
            <input type="text" name="courriel">
            <p><?php echo $json['login_password'] ?> : </p>
            <input type="password" name="mdp">
        </fieldset>
        <fieldset>
            <input type="submit" value="<?php echo $json['login_submit_btn'] ?>">
            <input type="reset" value="<?php echo $json['login_reset_btn'] ?>">
            <p id="erreur"></p>
            <p id="reserve"><?php echo $json['login_reserv'] ?></p>
        </fieldset>
    </form>
<?php
if(!empty($message)) echo $message;
include("inclus/piedPage.inc.php");
?>