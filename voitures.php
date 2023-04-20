<?php
session_start();
include("librairies/fonctions.lib.php");
$bd = null;
ConnecterBd($bd);
include("inclus/entete.inc.php");
?>
<!-- VOITURES -->
<h2 class="mb-4">Nos Voitures</h2>
<?php
// VERIFICATION NOMBRE DE VOITURES
if(CompterVoitures($bd) == 0){
    print("Aucune voitures.");
}
else{
    AfficherVoitures($bd);
}
include("inclus/piedPage.inc.php");
?>