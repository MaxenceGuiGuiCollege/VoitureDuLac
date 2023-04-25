<?php
session_start();
include("librairies/fonctions.lib.php");
//DEFINIR LA BD
$bd = null;
ConnecterBd($bd);
include("inclus/enteteAdmin.inc.php");
?>
    <!-- MODIFIER VOITURE -->
    <h2 class="mb-4">Modifier une Voiture</h2>
<?php
// VERIFICATION NOMBRE DE VOITURES
if(CompterVoitures($bd) == 0){
    print("Aucune Voitures...");
}
else{
    if(isset($_GET['no']))
        AfficherModifierVoitureSeule($bd, $_GET['no']);
    else
        AfficherModifierVoiture($bd);

}
include("inclus/piedPage.inc.php");
?>