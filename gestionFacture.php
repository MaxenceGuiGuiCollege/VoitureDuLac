<?php
session_start();
include("class/factureClass.php");
include("librairies/fonctions.lib.php");
//DEFINIR LA BD
$bd = null;
connecterBD($bd);
// VERIFICATION SI IL Y A UNE ACTION
if(isset($_GET['action'])){
    // VERIFICATION ACTION SUPPRIMER
    if($_GET['action'] == 'supprimer'){
        // VERIFICATION ID
        if(isset($_GET['no'])){

            $fact = new Facture($_GET['no']);
            $fact->supprimerFactureBD($bd);
        }
    }
}
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