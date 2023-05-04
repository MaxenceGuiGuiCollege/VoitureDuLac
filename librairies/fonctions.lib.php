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
//        $bd = new PDO('mysql:host=localhost; dbname=maxence_voitureDuLac; charset=utf8', 'maxence_root', 'infoMac420');
        $bd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e) {
        echo "Echec : " . $e->getMessage();
    }
}
// Fonction qui permet de connecter un usager.
function ConnecterUsager($bd, $courriel, $mdp, $lang){

    $json = obtenirJson($lang);

    $req = $bd->prepare("SELECT * FROM usager WHERE courriel = ?;");
    $req->execute([$courriel]);
    $nb = $req->rowCount();
    if($nb == 0){
        return "<script>document.getElementById('erreur').textContent = '".$json['login_error_password']."';</script>";
    }
    else{
        $ligne = $req->fetch();
        if(password_verify($mdp, $ligne['motPasse'])){
            return null;
        }
        else{
            return "<script>document.getElementById('erreur').textContent = '".$json['login_error_password']."';</script>";
        }
    }
}
// Fonction qui permet de compter le nombre de voitures.
function CompterVoitures($bd){
    $reqCount = $bd->prepare("SELECT COUNT(idVoiture) FROM voiture;");
    $reqCount->execute();
    return $reqCount->fetch()[0];
}
// Fonction qui permet de compter le nombre de réservations.
function CompterReservation($bd){
    $reqCount = $bd->prepare("SELECT COUNT(idReservation) FROM reservation WHERE dateFin >= current_date();");
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
function VerifierReservation($bd, $dateDebut, $courriel, $idVoiture, $lang){

    $json = obtenirJson($lang);

    $reqReserv = "SELECT * FROM reservation
                            WHERE noVoiture = '$idVoiture'
                                AND dateDebut <= '$dateDebut'
                                AND dateFin > '$dateDebut';";
    $resReserv = $bd->query($reqReserv);
    $nbReserv = $resReserv->rowCount();
    if($nbReserv != 0){
        return "<script>document.getElementById('erreur').textContent =
            '".$json['booking_error_car']."';</script>";

    }

    $reqClient = "SELECT * FROM client WHERE courriel = '$courriel'";
    $resClient = $bd->query($reqClient);
    $nbClient = $resClient->rowCount();
    if($nbClient == 0){
        return "<script>document.getElementById('erreur').textContent =
            '".$json['booking_error_email']."';</script>";
    }

    return null;
}
// Fonction qui ajoute la reservation séléctionnée par le client.
function AjouterReservation($bd, $dateDebut, $dateFin, $courriel, $idVoiture, $lang){

    $json = obtenirJson($lang);

    $reqClient = "SELECT idClient FROM client WHERE courriel = '$courriel'";
    $resClient = $bd->query($reqClient);
    $resClient->setFetchMode(PDO::FETCH_OBJ);

    $idClient = $resClient->fetchAll()[0]->idClient;

    $reqInsert = "INSERT INTO reservation(noVoiture, noClient, dateDebut, dateFin, status)
                    VALUES ($idVoiture, $idClient, '$dateDebut', '$dateFin', 0);";
    $bd->query($reqInsert);

    echo "<script>alert('La reservation à bien été reçue. Nous communiquerons avec vous pour confirmer la suite.');</script>";
}
// Fonction qui permet d'afficher le menu de modification des voitures.
function AfficherModifierVoiture($bd){
    $req = $bd->prepare("SELECT * FROM voiture;");
    $req->execute();
    $voitures = $req->fetchAll();
    print(" <table id='tableModifierVoiture' class='table'>
                <tr>
                    <th>Nom</th>
                    <th>Marque</th>
                    <th>Année</th>
                    <th>Km</th>
                    <th>Description</th>
                    <th></th>
                </tr>");
    foreach($voitures as $voiture){
        print(" <tr>
                    <td>".$voiture['nomVoiture']."</td>
                    <td>".$voiture['marque']."</td>
                    <td>".$voiture['annee']."</td>
                    <td>".$voiture['km']."</td>
                    <td>".$voiture['description_fr']."</td>
                    <td><a href='modifierVoiture.php?action=modifier&no=".$voiture['idVoiture']."'>Modifier</a></td>
                </tr>");
    }
    print(" </table>
            <p id='aide'>-> Selectionner la voiture à modifier en cliquant sur le lien modifier</p>");
}
// Fonction qui permet d'afficher la voiture seule selectionnée.
function AfficherModifierVoitureSeule($bd, $no){

    $req = $bd->prepare("SELECT * FROM voiture WHERE idVoiture = ?;");
    $req->execute([$no]);
    $ligne = $req->fetch();

    print("<form action='modifierVoiture.php?action=modifier&id=$no' name='formModifierVoiture' method='post'>
            <fieldset>
                <p>Nom de la voiture :</p>
                <input type='text' name='nom' id='nom' value='".$ligne['nomVoiture']."' required>
            </fieldset>

            <fieldset>
                <p>Marque :</p>
                <p>Année :</p>
                <p>Kilomètrage :</p>
                <input type='text' name='marque' id='marque' value='".$ligne['marque']."'>
                <input type='number' name='annee' id=vannee' value='".$ligne['annee']."' required>
                <input type='number' name='km' id='km' value='".$ligne['km']."' required>
            </fieldset>

            <fieldset>
                <p>Description (Français) :</p>
                <p>Description (Anglais) :</p>
                <textarea name='desFr' id='desFr'>".$ligne['description_fr']."</textarea>
                <textarea name='desEn' id='desEn'>".$ligne['description_en']."</textarea>
            </fieldset>

            <fieldset>
                <input type='submit' value='Modifier' class='btn btn-primary'>
                <input type='reset' value='Annuler' onclick='window.location.assign(\"modifierVoiture.php\");' class='btn btn-primary'>
                <p id='erreur'></p>
            </fieldset>
    </form>");
}
// Fonction qui permet d'afficher le menu de suppression des voitures.
function AfficherSupprimerVoiture($bd){
    $req = $bd->prepare("SELECT * FROM voiture;");
    $req->execute();
    $voitures = $req->fetchAll();
    print("
        <form action='supprimerVoiture.php?action=supprimer' name='formSupprimerVoiture' method='post'>
            <fieldset>
                <table id='tableSupprimerVoiture' class='table'>
                    <tr>
                        <th></th>
                        <th>Nom</th>
                        <th>Marque</th>
                        <th>Année</th>
                        <th>Km</th>
                        <th>Description</th>
                    </tr>");
    $cmpt = 0;
    foreach($voitures as $voiture){
        print("     <tr>
                        <td><input type='checkbox' name='chk".$voiture['idVoiture']."' id='chkNo$cmpt'></td>
                        <td>".$voiture['nomVoiture']."</td>
                        <td>".$voiture['marque']."</td>
                        <td>".$voiture['annee']."</td>
                        <td>".$voiture['km']."</td>
                        <td>".$voiture['description_fr']."</td>
                    </tr>");
        $cmpt++;
    }
    print("
                </table>
            </fieldset>
            <fieldset>
                <input type='button' onclick='verifierValeursSupprimer();' value='Supprimer'>
                <input type='reset' value='Annuler'>
                <p id='erreur'></p>
            </fieldset>
        </form>");
}
// Fonction qui permet d'afficher le menu de gestion des réservations.
function AfficherReservation($bd){
    $req = $bd->prepare("SELECT * FROM reservation WHERE dateFin >= current_date();");
    $req->execute();
    $reservs = $req->fetchAll();
    print(" <form action='gestionReservation.php?action=modifier' name='formReservation' method='post'>
                <table id='tableReservation' class='table'>
                    <tr>
                        <th></th>
                        <th>Voiture</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Statut</th>
                    </tr>");
    foreach($reservs as $reserv){
        $reqName = $bd->prepare("SELECT nomVoiture FROM voiture WHERE idVoiture = ?;");
        $reqName->execute([$reserv['noVoiture']]);
        $nameVoit = $reqName->fetchAll()[0][0];

        $selectedAttente = "";
        $selectedReserve = "";
        $selectedNonDispo = "";

        switch ($reserv['statut']){
            case 0:
                $selectedAttente = "selected";
                break;
            case 1:
                $selectedReserve = "selected";
                break;
            default:
                $selectedNonDispo = "selected";
                break;
        }

        print(" <tr>
                    <td>
                        <a href='gestionReservation.php?action=supprimer&no=".$reserv['idReservation']."'>
                            <img src='images/supprimer.png' alt='Logo supprimer'>
                        </a>
                    </td>
                    <td>".$nameVoit."</td>
                    <td>".$reserv['dateDebut']."</td>
                    <td>".$reserv['dateFin']."</td>
                    <td>
                        <select name='statut".$reserv['idReservation']."'>
                            <option ".$selectedAttente.">Attente</option>
                            <option ".$selectedReserve.">Réservé</option>
                            <option ".$selectedNonDispo.">Non-disponible</option>
                        </select>
                    </td>
                </tr>");
    }
    print("    </table>
                <input type='submit' value='Mettre à jour les réservations' class='btn btn-primary'>
            </form>");
}
// Fonction qui permet d'obtenir l'id le plus élévé de la table réservation.
function GetMaxIdReservation($bd){
    $req = $bd->prepare("SELECT MAX(idReservation) FROM reservation;");
    $req->execute();
    return $req->fetchAll()[0]['MAX(idReservation)'];
}
?>