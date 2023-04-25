<?php
session_start();
include("class/voitureClass.php");
include("librairies/fonctions.lib.php");
//DEFINIR LA BD
$bd = null;
ConnecterBd($bd);
// VERIFICATION SI IL Y A UNE ACTION
if(isset($_GET["action"])){
    // VERIFICATION ACTION SUPPRIMER
    if($_GET["action"] == "supprimer"){

        $nbr = CompterVoitures($bd);

        $reqId = $bd->prepare("SELECT idVoiture FROM voiture;");
        $reqId->execute();
        $allId = $reqId->fetchAll();

        for($i = 0; $i < $nbr; $i ++){

            $id = $allId[$i][0];

            if(isset($_POST["chk$id"])){

                $voiture = new Voiture($id);
                $voiture->supprimerVoitureBD($bd);
            }
        }
    }
}
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