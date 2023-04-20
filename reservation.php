<?php
session_start();
include("librairies/fonctions.lib.php");
$bd = null;
ConnecterBd($bd);
// INITIALISER LA SELECTION À NULL
$selection = null;
// VERIFICATION SELECTION
if(isset($_GET["select"])){
    $selection = $_GET["select"];
    pp($selection);
}
include("inclus/entete.inc.php");
?>
    <!-- RESERVATION -->
    <h2 class="mb-4">Réservation</h2>
    <form action="3" name="formReserv" method="post">
        <fieldset>
            <p>Date début</p>
            <p>Date fin</p>
            <input type="date" name="dateDebut" id="dateDebut" content="getDateToday();">
            <input type="date" name="dateFin" id="dateFin"">
        </fieldset>
        <fieldset>
            <p>Courriel du client</p>
            <input type="email" name="courriel">
        </fieldset>

        <fieldset>
            <p>Nos voiture</p>
            <div>
                <?php
                // VERIFICATION NOMBRE DE VOITURES
                if(CompterVoitures($bd) == 0){
                    print("Aucune voitures.");
                }
                else{
                    AfficherRadioVoitures($bd, $selection);
                }
                ?>
<!--        TODO: Afficher les radio btn avec PHP-->

            </div>
        </fieldset>

        <fieldset>
            <p>Code promo</p>
            <input type="text" name="promo">
        </fieldset>

        <fieldset>
            <input type="checkbox" name="assurance" id="assurance">
            <label for="assurance">Assurance supplémentaire</label>
        </fieldset>

        <fieldset>
            <input type="submit" value="Réserver" class="btn btn-primary">
            <p id="erreur"></p>
        </fieldset>
    </form>
<?php
include("inclus/piedPage.inc.php");
?>