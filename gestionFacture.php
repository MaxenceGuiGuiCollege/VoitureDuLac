<?php
include("librairies/fonctions.lib.php");
$bd = null;
connecterBD($bd);
include("inclus/enteteAdmin.inc.php");
?>
    <!-- GESTION FACTURE -->
    <h2 class='mb-4'>Gestion des Factures</h2>
<?php
// VERIFICATION NOMBRE DE RESERVATIONS
if(CompterFactures($bd) == 0){
    print("Aucune Factures...");
}
else{
    AfficherFactures($bd);

}
include("inclus/piedPage.inc.php");
?>