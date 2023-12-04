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
// VERIFICATION SI IL Y A UNE ACTION
if(isset($_GET["action"])){
  // VERIFICATION ACTION DECONNECTER
  if($_GET["action"] == "deconnecter") {
    $isConnected = false;
    $_SESSION['isConnected'] = false;
  }
}
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
<!-- INDEX -->
<h2 class="mb-4"><?php echo $json['index_title'] ?></h2>
<p><?php echo $json['index_text_1'] ?></p>
<p><?php echo $json['index_text_2'] ?></p>
<p><?php echo $json['index_text_3'] ?></p>
<?php
include("inclus/piedPage.inc.php");
?>