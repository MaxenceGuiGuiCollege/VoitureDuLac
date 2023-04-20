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
function AfficherVoitures($bd){

    $reqVoitures = "SELECT * FROM voiture";
    $resultatVoitures = $bd->query($reqVoitures);
    $resultatVoitures->setFetchMode(PDO::FETCH_OBJ);

    while($ligne = $resultatVoitures->fetch( )){

        print(" <div class='voiture'>
                    <img src='images/".$ligne->idVoiture.".jpg' alt='Image de ".$ligne->nomVoiture."'>
                    <div>
                        <p><strong>Nom : </strong>".$ligne->nomVoiture."</p>
                        <p><strong>Marque : </strong>".$ligne->marque."</p>
                        <p><strong>Année : </strong>".$ligne->annee."</p>
                        <p><strong>Kilometrage : </strong>".$ligne->km." km</p>
                    </div>
                    <p><strong>Description : </strong>".$ligne->description_fr."</p>
                </div>");
    }

//    print(" <div class='ps'>
//                <p>".$json['precision']."</p>
//            </div>");

    $resultatVoitures->closeCursor( );
}
?>