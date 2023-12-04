<?php

class Reservation{

    private $idReservation;
    private $noVoiture;
    private $noClient;
    private $dateDebut;
    private $dateFin;
    private $statut;

    public function __construct(){

        $ctp = func_num_args();
        $args = func_get_args();

        if($ctp == 1)
            $this->setIdReservation($args[0]);
        if($ctp == 2){
            $this->setIdReservation($args[0]);
            $this->setStatut($args[1]);
        }
        if($ctp == 4){
            $this->setIdReservation($args[0]);
            $this->setNoVoiture($args[1]);
            $this->setNoClient($args[2]);
            $this->setDateDebut($args[3]);
        }
        if($ctp == 5){
            $this->setNoVoiture($args[0]);
            $this->setNoClient($args[1]);
            $this->setDateDebut($args[2]);
            $this->setDateFin($args[3]);
            $this->setStatut($args[4]);
        }
        if($ctp == 6){
            $this->setIdReservation($args[0]);
            $this->setNoVoiture($args[1]);
            $this->setNoClient($args[2]);
            $this->setDateDebut($args[3]);
            $this->setDateFin($args[4]);
            $this->setStatut($args[5]);
        }
    }

    public function getIdReservation()
    {
        return $this->idReservation;
    }
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
    }

    public function getNoVoiture()
    {
        return $this->noVoiture;
    }
    public function setNoVoiture($noVoiture)
    {
        $this->noVoiture = $noVoiture;
    }

    public function getNoClient()
    {
        return $this->noClient;
    }
    public function setNoClient($noClient)
    {
        $this->noClient = $noClient;
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

    public function getStatut()
    {
        return $this->statut;
    }
    public function setStatut($statut)
    {
        $statutNb = null;

        switch ($statut){
            case "Attente":
                $this->statut = 0;
                break;
            case "Réservé":
                $this->statut = 1;
                break;
            case "Non-disponible":
                $this->statut = 2;
                break;
        }


    }

    public function ajouterReservationBD($bd){

        $data = [
            'iV' => $this->getNoVoiture(),
            'iC' => $this->getNoClient(),
            'dD' => $this->getDateDebut(),
            'dF' => $this->getDateFin(),
            's' => $this->getStatut()
        ];

        $reqA = $bd->prepare("INSERT INTO reservation(
                    noVoiture,
                    noClient,
                    dateDebut,
                    dateFin, 
                    statut) VALUES (:iV, :iC, :dD, :dF, :s);");
        $reqA->execute($data);

        $this->setIdReservation($bd->lastInsertId());

    }
    public function modifierReservationBD($bd){

        $data = [
            'i' => $this->getIdReservation(),
            'iV' => $this->getNoVoiture(),
            'iC' => $this->getNoClient(),
            'dD' => $this->getDateDebut(),
            'dF' => $this->getDateFin(),
            's' => $this->getStatut()
        ];

        $reqM = $bd->prepare("UPDATE reservation SET 
                   noVoiture = :iV,
                   noClient = :iC,
                   dateDebut = :dD,
                   dateFin = :dF,
                   statut = :s WHERE idReservation = :i;");
        $reqM->execute($data);
    }
    public function modifierStatusReservationBD($bd){

        $data = [
            'i' => $this->getIdReservation(),
            's' => $this->getStatut()
        ];

        $reqM = $bd->prepare("UPDATE reservation SET statut = :s WHERE idReservation = :i;");
        $reqM->execute($data);
    }
    public function supprimerReservationBD($bd){

        $data = [
            'i' => $this->getIdReservation()
        ];

        $reqS = $bd->prepare("DELETE FROM reservation WHERE idReservation = :i;");
        $reqS->execute($data);
    }
}

?>