#### Serveur mySQL 
## Hôte: localhost
## Nom d'usager: root

#### BD pour VoitureDuLac.com
## Nom de la base de donnée: voitureDuLac

CREATE DATABASE voitureDuLac
	DEFAULT CHARACTER SET utf8;
USE voitureDuLac;

#########################################################################
#DROP TABLE voiture;
CREATE TABLE voiture
(
    idVoiture       SMALLINT NOT NULL,
    nomVoiture      VARCHAR(30) NOT NULL,
    marque          VARCHAR(25),
    annee           SMALLINT NOT NULL,
    km              INT NOT NULL,
    description_fr  VARCHAR(150),
    description_en  VARCHAR(150),
    PRIMARY KEY (idVoiture)
);

#DROP TABLE client;
CREATE TABLE client
(
    idClient    SMALLINT NOT NULL,
    prenom      VARCHAR(25),
	nom         VARCHAR(25),
	courriel    VARCHAR(50) NOT NULL,
	telephone   VARCHAR(10) NOT NULL,
	PRIMARY KEY (idClient)
);

#DROP TABLE reservation;
CREATE TABLE reservation
(
    idReservation   SMALLINT NOT NULL,
    noVoiture       SMALLINT NOT NULL REFERENCES voiture(idVoiture),
    noClient        SMALLINT NOT NULL REFERENCES client(idClient),
    dateDebut       DATE NOT NULL,
	dateFin         DATE,
	status          TINYINT,
	PRIMARY KEY (idReservation, noVoiture)
);

#DROP TABLE facture;
CREATE TABLE facture
(
    idFacture       SMALLINT NOT NULL,
    noReservation   SMALLINT,
    noClient        SMALLINT NOT NULL,
    noVoiture       SMALLINT NOT NULL,
    dateDebut       DATE NOT NULL,
	dateFin         DATE,
    kmDebut         INT NOT NULL,
    kmFin           INT,
    montant         FLOAT,
    assurance       TINYINT(1),
    PRIMARY KEY (idFacture)
);

#DROP TABLE usager;
CREATE TABLE usager
(
    idUsager  SMALLINT NOT NULL,
    courriel  VARCHAR(50) NOT NULL,
    motPasse  VARCHAR(255) NOT NULL,
    PRIMARY KEY (idUsager)
);