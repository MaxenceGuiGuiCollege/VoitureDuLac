<?php
include("librairies/fonctions.lib.php");
//DEFINIR LA BD
$bd = null;
ConnecterBd($bd);
include("inclus/enteteAdmin.inc.php");
?>
    <!-- GESTION RESERVATION -->
    <h2 class="mb-4">Gestion des Réservations</h2>
<?php
// VERIFICATION NOMBRE DE RESERVATIONS
if(CompterReservation($bd) == 0){
    print("Aucune Réservations...");
}
else{
    AfficherReservation($bd);

}
include("inclus/piedPage.inc.php");
?>