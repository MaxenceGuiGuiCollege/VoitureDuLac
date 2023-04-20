<?php
session_start();
setcookie('lang', 'fr', time()+365*24*60*60);
include("librairies/fonctions.lib.php");
//$json = obtenirJson($_COOKIE["lang"]);
$json = obtenirJson("en");
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