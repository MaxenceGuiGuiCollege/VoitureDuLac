<?php

class factureClass{

    private $idFacture;
    private $noReservation;
    private $noClient;
    private $noVoiture;
    private $dateDebut;
    private $dateFin;
    private $kmDebut;
    private $kmFin;
    private $montant;
    private $assurance;

    public function __construct(){

        $ctp = func_num_args();
        $args = func_get_args();

        if($ctp == 1)
            $this->setIdFacture($args[0]);
        if($ctp == 4){
            $this->setNoClient($args[0]);
            $this->setNoVoiture($args[1]);
            $this->setDateDebut($args[2]);
            $this->setKmDebut($args[3]);
        }
        if($ctp == 5){
            $this->setIdFacture($args[0]);
            $this->setNoClient($args[1]);
            $this->setNoVoiture($args[2]);
            $this->setDateDebut($args[3]);
            $this->setKmDebut($args[4]);
        }
        if($ctp == 10){
            $this->setIdFacture($args[0]);
            $this->setNoReservation($args[1]);
            $this->setNoClient($args[2]);
            $this->setNoVoiture($args[3]);
            $this->setDateDebut($args[4]);
            $this->setDateFin($args[5]);
            $this->setKmDebut($args[6]);
            $this->setKmFin($args[7]);
            $this->setMontant($args[8]);
            $this->setAssurance($args[9]);
        }
    }

    public function getIdFacture()
    {
        return $this->idFacture;
    }
    public function setIdFacture($idFacture)
    {
        $this->idFacture = $idFacture;
    }

    public function getNoReservation()
    {
        return $this->noReservation;
    }
    public function setNoReservation($noReservation)
    {
        $this->noReservation = $noReservation;
    }

    public function getNoClient()
    {
        return $this->noClient;
    }
    public function setNoClient($noClient)
    {
        $this->noClient = $noClient;
    }

    public function getNoVoiture()
    {
        return $this->noVoiture;
    }
    public function setNoVoiture($noVoiture)
    {
        $this->noVoiture = $noVoiture;
    }

    public function getDateDebut()
    {
        return $this->dateDebut;
    }
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    public function getDateFin()
    {
        return $this->dateFin;
    }
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    public function getKmDebut()
    {
        return $this->kmDebut;
    }
    public function setKmDebut($kmDebut)
    {
        $this->kmDebut = $kmDebut;
    }

    public function getKmFin()
    {
        return $this->kmFin;
    }
    public function setKmFin($kmFin)
    {
        $this->kmFin = $kmFin;
    }

    public function getMontant()
    {
        return $this->montant;
    }
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    public function getAssurance()
    {
        return $this->assurance;
    }
    public function setAssurance($assurance)
    {
        $this->assurance = $assurance;
    }

    public function ajouterFactureBD($bd){

        $data = [
            'nR' => $this->getNoReservation(),
            'nC' => $this->getNoClient(),
            'nV' => $this->getNoVoiture(),
            'dD' => $this->getDateDebut(),
            'dF' => $this->getDateFin(),
            'kD' => $this->getKmDebut(),
            'kF' => $this->getKmFin(),
            'm' => $this->getMontant(),
            'a' => $this->getAssurance()
        ];

        $reqA = $bd->prepare("INSERT INTO facture(
                    noReservation,
                    noClient, 
                    noVoiture,
                    dateDebut,
                    dateFin,
                    kmDebut,
                    kmFin,
                    montant,
                    assurance) VALUES (:nR, :nC, :nV, :dD, :dF, :kD, :kF, :m, :a);");
        $reqA->execute($data);

        $this->setIdFacture($bd->lastInsertId());
    }
    public function modifierFactureBD($bd){

        $data = [
            'i' => $this->getIdFacture(),
            'nR' => $this->getNoReservation(),
            'nC' => $this->getNoClient(),
            'nV' => $this->getNoVoiture(),
            'dD' => $this->getDateDebut(),
            'dF' => $this->getDateFin(),
            'kD' => $this->getKmDebut(),
            'kF' => $this->getKmFin(),
            'm' => $this->getMontant(),
            'a' => $this->getAssurance()
        ];

        $reqM = $bd->prepare("UPDATE facture SET 
                   noReservation = :nR,
                   noClient = :nC,
                   noVoiture = :nV,
                   dateDebut = :dD,
                   dateFin = :dF,
                   kmDebut = :kD,
                   kmFin = :kF,
                   montant = :m,
                   assurance = :a WHERE idFacture = :i;");
        $reqM->execute($data);
    }
    public function supprimerFactureBD($bd){

        $data = [
            'i' => $this->getIdFacture()
        ];

        $reqS = $bd->prepare("DELETE FROM facture WHERE idFacture = :i;");
        $reqS->execute($data);
    }
}

?>