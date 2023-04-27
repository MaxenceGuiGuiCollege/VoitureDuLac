

#DROP TABLE voiture;
CREATE TABLE voiture
(
    idVoiture       SMALLINT NOT NULL AUTO_INCREMENT,
    nomVoiture      VARCHAR(30) NOT NULL,
    marque          VARCHAR(25),
    annee           SMALLINT NOT NULL,
    km              INT NOT NULL,
    description_fr  VARCHAR(150),
    description_en  VARCHAR(150),
    PRIMARY KEY (idVoiture)
);
insert into voiture (nomVoiture, marque, annee, km, description_fr, description_en) values ('Orange','Vokswagen', 1966, 142365, 'La Volkswagen Coccinelle, est la voiture la plus vendue de tout les temps.', 'The Volkswagen Beetle is the best-selling car of all time.');
insert into voiture (nomVoiture, marque, annee, km, description_fr, description_en) values ('Bleu','Mercedes', 2020, 14975, 'Vous apprécierez le confort et luxe de cette berline.', 'You will appreciate the comfort and luxury of this sedan.');
insert into voiture (nomVoiture, marque, annee, km, description_fr, description_en) values ('Rouge','Ferrari', 2021, 18588, 'Cette belle italienne, qui n\'a jamais vu la neige, fera rougir tous vos amis.', 'This beautiful Italian, who has never seen snow, will make all your friends blush.');
insert into voiture (nomVoiture, marque, annee, km, description_fr, description_en) values ('Blanc','Range Rover', 2022, 97581, 'Ce véhicule utilitaire de luxe vous surprendra par sa tenue de route et la qualité de son habitacle.', 'This luxury utility vehicle will surprise you with its handling and the quality of its interior.');
insert into voiture (nomVoiture, marque, annee, km, description_fr, description_en) values ('Rose','Limousine', 1998, 97468, 'Pouvant accueillir 15 personnes, cette voiture vous permettra de faire un entré des plus remarqué !', 'Able to accommodate 15 people, this car will allow you to make a most noticeable entrance!');

#DROP TABLE client;
CREATE TABLE client
(
    idClient    SMALLINT NOT NULL AUTO_INCREMENT,
    prenom      VARCHAR(25),
	nom         VARCHAR(25),
	courriel    VARCHAR(50) NOT NULL,
	telephone   VARCHAR(10) NOT NULL,
	PRIMARY KEY (idClient)
);
insert into client (prenom, nom, courriel, telephone) values ('Gerard','Guidez', '1945@collegealma.ca', '0680720368');
insert into client (prenom, nom, courriel, telephone) values ('Marianne','Szij', '1971@collegealma.ca', '0660661114');
insert into client (prenom, nom, courriel, telephone) values ('Prenom','Nom', 'prenom.nom@collegealma.ca', '4186682387');

#DROP TABLE reservation;
CREATE TABLE reservation
(
    idReservation   SMALLINT NOT NULL AUTO_INCREMENT,
    noVoiture       SMALLINT NOT NULL REFERENCES voiture(idVoiture),
    noClient        SMALLINT NOT NULL REFERENCES client(idClient),
    dateDebut       DATE NOT NULL,
	dateFin         DATE,
	statut          TINYINT,
	PRIMARY KEY (idReservation, noVoiture)
);

INSERT INTO reservation (noClient, noVoiture, dateDebut, dateFin, statut) VALUES (1,1,'2023-03-17', '2023-03-22',0);
INSERT INTO reservation (noClient, noVoiture, dateDebut, dateFin, statut) VALUES (1,1,'2023-04-17', '2023-04-26',0);
INSERT INTO reservation (noClient, noVoiture, dateDebut, dateFin, statut) VALUES (2,4,'2023-04-17', '2023-05-22',0);
INSERT INTO reservation (noClient, noVoiture, dateDebut, dateFin, statut) VALUES (3,5,'2023-04-27', '2023-04-30',0);
INSERT INTO reservation (noClient, noVoiture, dateDebut, dateFin, statut) VALUES (3,2,'2023-04-26', '2023-04-28',0);
INSERT INTO reservation (noClient, noVoiture, dateDebut, dateFin, statut) VALUES (2,3,'2023-04-17', '2023-04-27',0);
INSERT INTO reservation (noClient, noVoiture, dateDebut, dateFin, statut) VALUES (1,1,'2023-05-17', '2023-05-22',0);


#DROP TABLE facture;
CREATE TABLE facture
(
    idFacture       SMALLINT NOT NULL AUTO_INCREMENT,
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
    idUsager  SMALLINT NOT NULL AUTO_INCREMENT,
    courriel  VARCHAR(50) NOT NULL,
    motPasse  VARCHAR(255) NOT NULL,
    PRIMARY KEY (idUsager)
);