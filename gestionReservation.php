<?php
session_start();
include("class/reservationClass.php");
include("librairies/fonctions.lib.php");
//DEFINIR LA BD
$bd = null;
ConnecterBd($bd);
// VERIFICATION SI IL Y A UNE ACTION
if(isset($_GET['action'])){
    // VERIFICATION ACTION SUPPRIMER
    if($_GET['action'] == 'supprimer'){
        // VERIFICATION ID
        if(isset($_GET['no'])){

            $reserv = new Reservation($_GET['no']);
            $reserv->supprimerReservationBD($bd);
        }
    }
}
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