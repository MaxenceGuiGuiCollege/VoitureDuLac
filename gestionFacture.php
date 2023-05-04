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

            if(isset($_POST['assurance']))
                $ass = 1;
            else
                $ass = 0;

            if($_POST['montant'] != null)
                $mont = $_POST['montant'];
            else
                $mont = 0;

            if(isset($_GET['tot']))
                $mont = $_GET['tot'];

            $req = $bd->prepare("SELECT idVoiture FROM voiture
                                WHERE nomVoiture = '".$_POST['voiture']."';");
            $req->execute();
            $ligne = $req->fetch();

            $fact = new Facture($_GET['num'], $ligne['idVoiture'],$_POST['kmFin'], $_POST['dateFin'], $ass, $mont);
            $fact->modifierFactureBD($bd);
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