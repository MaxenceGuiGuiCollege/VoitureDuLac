<?php

class Voiture{

    private $idVoiture;
    private $nomVoiture;
    private $marque;
    private $annee;
    private $km;
    private $description_fr;
    private $description_en;

    public function __construct(){

        $ctp = func_num_args();
        $args = func_get_args();

        if($ctp == 1)
            $this->setIdVoiture($args[0]);
        if($ctp == 3){
            $this->setNomVoiture($args[0]);
            $this->setAnnee($args[1]);
            $this->setKm($args[2]);
        }
        if($ctp == 4){
            $this->setIdVoiture($args[0]);
            $this->setNomVoiture($args[1]);
            $this->setAnnee($args[2]);
            $this->setKm($args[3]);
        }
        if($ctp == 6){
            $this->setNomVoiture($args[0]);
            $this->setMarque($args[1]);
            $this->setAnnee($args[2]);
            $this->setKm($args[3]);
            $this->setDescriptionFr($args[4]);
            $this->setDescriptionEn($args[5]);
        }
        if($ctp == 7){
            $this->setIdVoiture($args[0]);
            $this->setNomVoiture($args[1]);
            $this->setMarque($args[2]);
            $this->setAnnee($args[3]);
            $this->setKm($args[4]);
            $this->setDescriptionFr($args[5]);
            $this->setDescriptionEn($args[6]);
        }
    }

    public function getIdVoiture()
    {
        return $this->idVoiture;
    }
    public function setIdVoiture($idVoiture)
    {
        $this->idVoiture = $idVoiture;
    }

    public function getNomVoiture()
    {
        return $this->nomVoiture;
    }
    public function setNomVoiture($nomVoiture)
    {
        $this->nomVoiture = $nomVoiture;
    }

    public function getMarque()
    {
        return $this->marque;
    }
    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    public function getAnnee()
    {
        return $this->annee;
    }
    public function setAnnee($annee)
    {
        $this->annee = $annee;
    }

    public function getKm()
    {
        return $this->km;
    }
    public function setKm($km)
    {
        $this->km = $km;
    }

    public function getDescriptionFr()
    {
        return $this->description_fr;
    }
    public function setDescriptionFr($description_fr)
    {
        $this->description_fr = $description_fr;
    }

    public function getDescriptionEn()
    {
        return $this->description_en;
    }
    public function setDescriptionEn($description_en)
    {
        $this->description_en = $description_en;
    }

    public function ajouterVoitureBD($bd){

        $data = [
            'n' => $this->getNomVoiture(),
            'm' => $this->getMarque(),
            'a' => $this->getAnnee(),
            'k' => $this->getKm(),
            'dFr' => $this->getDescriptionFr(),
            'dEn' => $this->getDescriptionEn()
        ];

        $reqA = $bd->prepare("INSERT INTO voiture(
                    nomVoiture,
                    marque,
                    annee,
                    km, 
                    description_fr,
                    description_en) VALUES (:n, :m, :a, :k, :dFr, :dEn);");
        $reqA->execute($data);

        $this->setIdVoiture($bd->lastInsertId());

        $this->ajouterImage();
    }
    public function modifierVoitureBD($bd){

        $data = [
            'i' => $this->getIdVoiture(),
            'n' => $this->getNomVoiture(),
            'm' => $this->getMarque(),
            'a' => $this->getAnnee(),
            'k' => $this->getKm(),
            'dFr' => $this->getDescriptionFr(),
            'dEn' => $this->getDescriptionEn()
        ];

        $reqM = $bd->prepare("UPDATE voiture SET 
                   nomVoiture = :n,
                   marque = :m,
                   annee = :a,
                   km = :k,
                   description_fr = :dFr,
                   description_en = :dEn WHERE idVoiture = :i;");
        $reqM->execute($data);

        $this->modifierImage();
    }
    public function supprimerVoitureBD($bd){

        $data = [
            'i' => $this->getIdVoiture()
        ];

        $reqS = $bd->prepare("DELETE FROM voiture WHERE idVoiture = :i;");
        $reqS->execute($data);

        $this->supprimerImage();
    }

    private function ajouterImage(){

        $id = $this->idVoiture;

        rename("temp/img_temp.png", "images/$id.jpg");

    }
    private function supprimerImage(){

        $id = $this->idVoiture;

        if(file_exists("images/$id.jpg")){
            unlink("images/$id.jpg");
        }

    }
    private function modifierImage(){

        if(file_exists("temp/img_temp.jpg")) {
            $this->supprimerImage();
            $this->ajouterImage();
        }
    }
}

?>