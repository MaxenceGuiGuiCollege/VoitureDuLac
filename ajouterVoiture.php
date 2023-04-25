<?php
session_start();
include("class/voitureClass.php");
include("librairies/fonctions.lib.php");
//DEFINIR LA BD
$bd = null;
ConnecterBd($bd);
// VERIFICATION SI IL Y A UNE ACTION
if(isset($_GET['action'])){
    // VERIFICATION ACTION AJOUTER
    if($_GET['action'] == 'ajouter'){

        $voiture = new Voiture($_POST['nom'], $_POST['marque'], $_POST['annee'], $_POST['km'], $_POST['desFr'], $_POST['desEn']);
        $voiture->ajouterVoitureBD($bd);
    }
}
include("inclus/enteteAdmin.inc.php");
?>
    <!-- AJOUTER VOITURE -->
    <h2 class="mb-4">Ajouter une Voiture</h2>
    <form action="ajouterVoiture.php?action=ajouter" name="formAjouterVoiture" method="post">
            <fieldset>
                <p>Nom de la voiture :</p>
                <input type="text" name="nom" id="nom" required>

                <p>Marque :</p>
                <input type="text" name="marque" id="marque">
            </fieldset>

            <fieldset>
                <p>Année :</p>
                <p>Kilomètrage :</p>
                <input type="number" name="annee" id="annee" required>
                <input type="number" name="km" id="km" required>
            </fieldset>

            <fieldset>
                <p>Description (Français) :</p>
                <p>Description (Anglais) :</p>
                <textarea name="desFr" id="desFr"></textarea>
                <textarea name="desEn" id="desEn"></textarea>
            </fieldset>

            <input type="file" value="Choisir un fichier" required>

            <fieldset>
                <input type="submit" value="Ajouter" onclick="verifierValeursAjouter();" class="btn btn-primary">
                <input type="reset" value="Annuler" class="btn btn-primary">
            </fieldset>
            <p id="erreur"></p>
    </form>
<?php
include("inclus/piedPage.inc.php");
?>