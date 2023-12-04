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
<!-- REJOINDRE -->
<h2 class="mb-4"><?php echo $json['contact_title'] ?></h2>
<p>
    Voiture du Lac <br>
    321, route du Lac <br>
    Alma (Québec) <br>
    G8B 2B7
</p>
<p>
    <?php echo $json['contact_phone'] ?> : 418-123-1234 <br>
    <?php echo $json['contact_email'] ?> : info@voitureDuLac.org
</p>
<p>
    Facebook : <br>
    Instagram :
</p>
<?php
include("inclus/piedPage.inc.php");
?>