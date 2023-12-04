<?php
session_start();
include("class/factureClass.php");
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
    // VERIFICATION ACTION MODIFIER
    else if($_GET['action'] == 'modifier'){
        for ($i = 0; $i <= GetMaxIdReservation($bd); $i++) {
            if(isset($_POST['statut'.$i])){
                $reserv = new Reservation($i, $_POST['statut'.$i]);
                $reserv->modifierStatusReservationBD($bd);

                if($reserv->getStatut() == 1){
                    $reqR = $bd->prepare("SELECT * FROM reservation WHERE idReservation = $i;");
                    $reqR->execute();
                    $reservBD = $reqR->fetchAll()[0];

                    $reqV = $bd->prepare("SELECT km FROM voiture WHERE idVoiture = ".$reservBD['noVoiture'].";");
                    $reqV->execute();
                    $voitureBD = $reqV->fetchAll()[0];

                    $facture = new Facture(
                        $reservBD['noClient'],
                        $reservBD['noVoiture'],
                        $reservBD['dateDebut'],
                        $voitureBD['km']
                    );
                    $facture->ajouterFactureBD($bd);
                }
            }
        }
    }
}
include("inclus/enteteAdmin.inc.php");
?>
    <!-- GESTION RESERVATION -->
    <h2 class="mb-4">Gestion des Réservations</h2>
<?php
// VERIFICATION NOMBRE DE RESERVATIONS
if(CompterReservations($bd) == 0){
    print("Aucune Réservations...");
}
else{
    AfficherReservations($bd);

}
include("inclus/piedPage.inc.php");
?>