<?php
// INCLURE LES FONCTIONS PHP
include("../librairies/fonctions.lib.php");
// CONNECTER BD
$bd;
ConnecterBd($bd);
// CREER UN MDP
$mdp = 'test';
$mdpCrypt = password_hash($mdp, PASSWORD_DEFAULT);
// INSERER LES DONNEES
$data = [
    'i' => 1,
    'c' => '202130087@collegealma.ca',
    'm' => $mdpCrypt
];
$requete = $bd->prepare("INSERT INTO usager(idUsager, courriel, motPasse) VALUES (:i, :c, :m);");
$requete->execute($data);
?>