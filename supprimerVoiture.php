<?php
session_start();
include("librairies/fonctions.lib.php");
//DEFINIR LA BD
$bd = null;
ConnecterBd($bd);
include("inclus/enteteAdmin.inc.php");
?>
    <!-- SUPPRIMER VOITURE -->
    <h2 class="mb-4">Supprimer une Voiture</h2>
<?php
// VERIFICATION NOMBRE DE VOITURES
if(CompterVoitures($bd) == 0){
    print("Aucune Voitures...");
}
else{
    AfficherSupprimerVoiture($bd);
}
include("inclus/piedPage.inc.php");
?>