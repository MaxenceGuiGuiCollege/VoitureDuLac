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
<!-- TARIFS -->
<h2 class="mb-4"><?php echo $json['prices_title'] ?></h2>
<table class="table">
    <tr>
        <th><?php echo $json['prices_service'] ?></th>
        <th><?php echo $json['prices_price'] ?></th>
    </tr>
    <tr>
        <td rowspan="4"><?php echo $json['prices_car'] ?></td>
        <td>100$/<?php echo $json['prices_day'] ?></td>
    </tr>
    <tr>
        <td>0$ <?php echo $json['prices_if'] ?> <= 100km</td>
    </tr>
    <tr>
        <td>0.10$/km <?php echo $json['prices_if'] ?> > 100km</td>
    </tr>
    <tr>
        <td>24.99$/<?php echo $json['prices_day'] ?> <?php echo $json['prices_insurance'] ?></td>
    </tr>
    <tr>
        <td rowspan="2"><?php echo $json['prices_driver'] ?></td>
        <td>25$/<?php echo $json['prices_hour'] ?> <?php echo $json['prices_maxtime'] ?></td>
    </tr>
    <tr>
        <td>1000$/<?php echo $json['prices_week'] ?></td>
    </tr>
    <tr>
        <td rowspan="3"><?php echo $json['prices_photo'] ?></td>
        <td>50$/<?php echo $json['prices_hour'] ?> <?php echo $json['prices_content_photoshoot'] ?></td>
    </tr>
    <tr>
        <td>15$ <?php echo $json['prices_allphotos'] ?></td>
    </tr>
    <tr>
        <td>7.50$ <?php echo $json['prices_paperphoto'] ?></td>
    </tr>
</table>
<?php
include("inclus/piedPage.inc.php");
?>