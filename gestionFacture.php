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
    // VERIFICATION ACTION MODIFIER
    else if($_GET['action'] == 'modifier'){
        // VERIFICATION ID
        if(isset($_GET['num'])){

            //TODO
        }
    }
}
include("inclus/enteteAdmin.inc.php");
?>
    <!-- GESTION FACTURE -->
<?php
// VERIFICATION NOMBRE DE RESERVATIONS
if(CompterFactures($bd) == 0){
    print("<h2 class='mb-4'>Gestion des Factures</h2>");
    print("Aucune Factures...");
}
else{
    if(isset($_GET['id']))
        AfficherFactureSeule($bd, $_GET['id']);
    else
        AfficherFactures($bd);
}
include("inclus/piedPage.inc.php");
?>