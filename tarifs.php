<?php
include("inclus/entete.inc.php");
?>
<!-- TARIFS -->
<h2 class="mb-4">Nos Tarifs</h2>
<table class="table">
    <tr>
        <th>Service</th>
        <th>Prix</th>
    </tr>
    <tr>
        <td rowspan="4">Voiture</td>
        <td>100$/jour</td>
    </tr>
    <tr>
        <td>0$ si <= 100km</td>
    </tr>
    <tr>
        <td>0.10$/km si > 100km</td>
    </tr>
    <tr>
        <td>24.99$/jour Assurance (si besoin)</td>
    </tr>
    <tr>
        <td rowspan="2">Chauffeur</td>
        <td>25$/heure (maximum 8 heures/jour)</td>
    </tr>
    <tr>
        <td>1000$/semaine</td>
    </tr>
    <tr>
        <td rowspan="3">Photo</td>
        <td>50$/heure (Séance de photo incluant 5 photos numérique et une photo papier)</td>
    </tr>
    <tr>
        <td>15$ Toutes les photos numérique</td>
    </tr>
    <tr>
        <td>7.50$ Une photo papier</td>
    </tr>
</table>
<?php
include("inclus/piedPage.inc.php");
?>