<?php
session_start();
include("librairies/fonctions.lib.php");
//DEFINIR LA LANGUE
if(isset($_GET['lang']))
    $lang = $_GET['lang'];
else if(isset($_COOKIE['lang']))
    $lang = $_COOKIE['lang'];
else
    $lang = "fr";
setcookie('lang', $lang, time()+365*24*60*60);
$json = obtenirJson($lang);
//DEFINIR LA BD
$bd = null;
ConnecterBd($bd);
// INITIALISER LA SELECTION À NULL
$selection = null;
// VERIFICATION SELECTION
if(isset($_GET["select"])){
    $selection = $_GET["select"];
}
include("inclus/entete.inc.php");
?>
    <!-- RESERVATION -->
    <h2 class="mb-4"><?php echo $json['booking_title'] ?></h2>
    <form action="3" name="formReserv" method="post">
        <fieldset>
            <p><?php echo $json['booking_date_start'] ?></p>
            <p><?php echo $json['booking_date_end'] ?></p>
            <input type="date" name="dateDebut" id="dateDebut">
            <input type="date" name="dateFin" id="dateFin"">
        </fieldset>
        <fieldset>
            <p><?php echo $json['booking_email'] ?></p>
            <input type="email" name="courriel">
        </fieldset>

        <fieldset>
            <p><?php echo $json['booking_cars'] ?></p>
            <div>
                <?php
                // VERIFICATION NOMBRE DE VOITURES
                if(CompterVoitures($bd) == 0){
                    echo $json['booking_no_cars'];
                }
                else{
                    AfficherRadioVoitures($bd, $selection);
                }
                ?>
            </div>
        </fieldset>

        <fieldset>
            <p><?php echo $json['booking_code'] ?></p>
            <input type="text" name="promo">
        </fieldset>

        <fieldset>
            <input type="checkbox" name="assurance" id="assurance">
            <label for="assurance"><?php echo $json['booking_insurance'] ?></label>
        </fieldset>

        <fieldset>
            <input type="submit" value="<?php echo $json['booking_book_btn'] ?>" class="btn btn-primary">
            <p id="erreur"></p>
        </fieldset>
    </form>
<?php
include("inclus/piedPage.inc.php");
?>