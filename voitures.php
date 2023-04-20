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
$bd = null;
ConnecterBd($bd);
//VERIFICATION CONNEXION
if(isset($_SESSION['isConnected'])){
    if($_SESSION['isConnected'])
        include("inclus/enteteAdmin.inc.php");
    else
        include("inclus/entete.inc.php");
}
else{
    include("inclus/entete.inc.php");
}
?>
<!-- VOITURES -->
<h2 class="mb-4"><?php echo $json['cars_title'] ?></h2>
<?php
// VERIFICATION NOMBRE DE VOITURES
if(CompterVoitures($bd) == 0){
    print("Aucune voitures.");
}
else{
    AfficherVoitures($bd, $lang);
}
include("inclus/piedPage.inc.php");
?>