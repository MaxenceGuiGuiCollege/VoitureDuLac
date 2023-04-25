<?php
session_start();
include("class/voitureClass.php");
include("librairies/fonctions.lib.php");
//DEFINIR LA BD
$bd = null;
ConnecterBd($bd);
// VERIFICATION SI IL Y A UNE ACTION
if(isset($_GET['action'])){
    // VERIFICATION ACTION MODIFIER
    if($_GET['action'] == 'modifier'){
        // VERIFICATION ID
        if(isset($_GET['id'])){
            $voiture = new Voiture($_GET['id'], $_POST['nom'], $_POST['marque'], $_POST['annee'], $_POST['km'], $_POST['desFr'], $_POST['desEn']);
            $voiture->modifierVoitureBD($bd);
        }
    }
}
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