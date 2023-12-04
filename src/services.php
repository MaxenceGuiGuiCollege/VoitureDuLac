<?php
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
include("inclus/entete.inc.php");
?>
<!-- SERVICES -->
<h2 class="mb-4"><?php echo $json['services_title'] ?></h2>
<h6><?php echo $json['services_cars'] ?></h6>
<p><?php echo $json['services_cars_text'] ?></p>
<h6 class="mt-5"><?php echo $json['services_drivers'] ?></h6>
<p><?php echo $json['services_drivers_text'] ?></p>
<h6 class="mt-5"><?php echo $json['services_photos'] ?></h6>
<p><?php echo $json['services_photos_text'] ?></p>
<?php
include("inclus/piedPage.inc.php");
?>