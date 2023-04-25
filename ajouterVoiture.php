<?php
include("inclus/enteteAdmin.inc.php");
?>
    <!-- AJOUTER VOITURE -->
    <h2 class="mb-4">Ajouter une Voiture</h2>
    <form action="#" name="formAjouterVoiture" method="post">
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

            <input type="file" value="Choisir un fichier">

            <fieldset>
                <input type="submit" value="Ajouter" class="btn btn-primary">
                <input type="reset" value="Annuler" class="btn btn-primary">
                <p id="erreur"></p>
            </fieldset>
    </form>
<?php
include("inclus/piedPage.inc.php");
?>