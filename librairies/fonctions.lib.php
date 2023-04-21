<?php
// Fonction d'aide au debug
function pp($obj, $die = true){
    echo "<pre>";
    print_r ($obj);
    echo "</pre>";
    if($die){
        die;
    }
}
// Fonction qui permet de faire une connexion avec la base de données séléctionnée.
function ConnecterBd(&$bd){
    try {
        $bd = new PDO('mysql:host=localhost; dbname=voitureDuLac; charset=utf8', 'root', 'infoMac420');
        // $bd = new PDO('mysql:host=localhost; dbname=maxence_voitureDuLac; charset=utf8', 'maxence_root', 'infoMac420');
        $bd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e) {
        echo "Echec : " . $e->getMessage();
    }
}
// Fonction qui permet de connecter un usager.
function ConnecterUsager($bd, $courriel, $mdp){
    $req = $bd->prepare("SELECT * FROM usager WHERE courriel = ?;");
    $req->execute([$courriel]);
    $nb = $req->rowCount();
    if($nb == 0){
        return "<script>document.getElementById('erreur').textContent = 'Vérifier votre mot de passe.';</script>";
    }
    else{
        $ligne = $req->fetch();
        if(password_verify($mdp, $ligne['motPasse'])){
            return null;
        }
        else{
            return "<script>document.getElementById('erreur').textContent = 'Vérifier votre mot de passe.';</script>";
        }
    }
}
// Fonction qui permet de compter le nombre de voitures.
function CompterVoitures($bd){
    $reqCount = $bd->prepare("SELECT COUNT(idVoiture) FROM voiture;");
    $reqCount->execute();
    return $reqCount->fetch()[0];
}
// Fonction qui permet d'afficher la liste des voitures.
function AfficherVoitures($bd, $lang){

    $json = obtenirJson($lang);
    $nameDescription = "description_".$lang;

    $reqVoitures = "SELECT * FROM voiture";
    $resultatVoitures = $bd->query($reqVoitures);
    $resultatVoitures->setFetchMode(PDO::FETCH_OBJ);

    while($ligne = $resultatVoitures->fetch( )){

        print(" <div class='voiture'>
                    <img src='images/".$ligne->idVoiture.".jpg' alt='Image de ".$ligne->nomVoiture."'>
                    <div>
                        <h4>".$ligne->nomVoiture."</h4>
                        <p>".$json['cars_brand']." : ".$ligne->marque."</p>
                        <p>".$json['cars_year']." : ".$ligne->annee."</p>
                        <p>".$ligne->$nameDescription."</p>
                        <a href='reservation.php?select=".$ligne->idVoiture."'>".$json['cars_book_btn']."</a>
                    </div>
                </div>");
    }

    $resultatVoitures->closeCursor( );
}
// Fonction qui permet d'afficher la liste des radio boutons des voitures pour la page de réservation.
function AfficherRadioVoitures($bd, $selection){

    $reqVoitures = "SELECT * FROM voiture";
    $resultatVoitures = $bd->query($reqVoitures);
    $resultatVoitures->setFetchMode(PDO::FETCH_OBJ);

    while($ligne = $resultatVoitures->fetch( )){

        if($ligne->idVoiture == $selection){
            $checked = "checked";
        }
        else{
            $checked = "";
        }

        print(" <input type='radio' name='voitures' id='radio".$ligne->nomVoiture."' value='".$ligne->idVoiture."' $checked required>
                <label for='radio".$ligne->nomVoiture."'>".$ligne->nomVoiture."</label>");
    }

    $resultatVoitures->closeCursor( );
}
// Fonction qui permet d'obtenir le json.
function obtenirJson($lang){
    $contenu_json = file_get_contents('lang/'.$lang.'.json');

    return json_decode($contenu_json, true);
}
// Fonction qui vérifie si la reservation séléctionnée par le client est possible.
function VerifierReservation($bd, $dateDebut, $courriel, $idVoiture){

    $reqReserv = "SELECT * FROM reservation
                            WHERE noVoiture = '$idVoiture'
                                AND dateDebut <= '$dateDebut'
                                AND dateFin > '$dateDebut';";
    $resReserv = $bd->query($reqReserv);
    $nbReserv = $resReserv->rowCount();
    if($nbReserv != 0){
        return "<script>document.getElementById('erreur').textContent =
            'La voiture choisie n\'est pas disponible dans les dates séléctionnées.';</script>";
    }

    $reqClient = "SELECT * FROM client WHERE courriel = '$courriel'";
    $resClient = $bd->query($reqClient);
    $nbClient = $resClient->rowCount();
    if($nbClient == 0){
        return "<script>document.getElementById('erreur').textContent =
            'Le courriel n\'est pas inscrit dans la liste de nos client.';</script>";
    }

    return null;
}
// Fonction qui ajoute la reservation séléctionnée par le client.
function AjouterReservation($bd, $dateDebut, $dateFin, $courriel, $idVoiture){

    $reqClient = "SELECT idClient FROM client WHERE courriel = '$courriel'";
    $resClient = $bd->query($reqClient);
    $resClient->setFetchMode(PDO::FETCH_OBJ);

    $idClient = $resClient->fetchAll()[0]->idClient;

    $reqInsert = "INSERT INTO reservation(noVoiture, noClient, dateDebut, dateFin, status)
                    VALUES ($idVoiture, $idClient, '$dateDebut', '$dateFin', 0);";
    $bd->query($reqInsert);

    echo "<script>alert('La reservation à bien été reçue. Nous communiquerons avec vous pour confirmer la suite.');</script>";
}
?>