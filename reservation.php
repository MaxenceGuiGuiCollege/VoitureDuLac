<?php
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
<!--        TODO: Afficher les radio btn avec PHP-->
                <input type="radio" name="voitures" id="radioOrange" checked>
                <label for="radioOrange">Orange</label>
                <input type="radio" name="voitures" id="radioBleu">
                <label for="radioBleu">Bleu</label>
                <input type="radio" name="voitures" id="radioRouge">
                <label for="radioRouge">Rouge</label>
                <input type="radio" name="voitures" id="radioBlanc">
                <label for="radioBlanc">Blanc</label>
                <input type="radio" name="voitures" id="radioRose">
                <label for="radioRose">Rose</label>
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