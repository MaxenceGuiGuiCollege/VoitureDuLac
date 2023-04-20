<?php
include("librairies/fonctions.lib.php");
//DEFINIR LA LANGUE
if(isset($_GET['lang']))
    $lang = $_GET['lang'];
else if(isset($_COOKIE['lang']))
    $lang = $_COOKIE['lang'];
else
    $lang = "fr";
$json = obtenirJson($lang);
include("inclus/entete.inc.php");
?>
<!-- SERVICES -->
<h2 class="mb-4"><?php echo $json['services_title'] ?></h2>
<h6><?php echo $json['services_services'] ?></h6>
<p><?php echo $json['services_services_text'] ?></p>
<h6 class="mt-5"><?php echo $json['services_drivers'] ?></h6>
<p><?php echo $json['services_drivers_text'] ?></p>
<h6 class="mt-5"><?php echo $json['services_photo'] ?></h6>
<p><?php echo $json['services_photo_text'] ?></p>
<?php
include("inclus/piedPage.inc.php");
?>