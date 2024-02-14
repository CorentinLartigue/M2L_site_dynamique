<?php

$_SESSION['listeInfos'] = utilisateurDAO::mesInfos($_SESSION['identification']);
$formulaireInfos = new Formulaire('post', 'index.php', 'fInfos', 'fInfos');

$nomLigue = $_SESSION['listeInfos'][0]['nomLigue'];
$nomClub = $_SESSION['listeInfos'][0]['nomClub'];
$nom = $_SESSION['listeInfos'][0]['nom'];
$prenom = $_SESSION['listeInfos'][0]['prenom'];
$libelleFonction = $_SESSION['listeInfos'][0]['libelle'];
$statut = $_SESSION['listeInfos'][0]['status'];


$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerLabel("Nom de la ligue : "));
$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerInputTexte("nomLigue", "nomLigue",$nomLigue, 1, "Nom de la ligue", "",1));
$formulaireInfos->ajouterComposantTab();

$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerLabel("Nom du club : "));
$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerInputTexte("nomClub", "nomClub", $nomClub, 1 , "Nom du club", "",1));
$formulaireInfos->ajouterComposantTab();

$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerLabel("Nom : "));
$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerInputTexte("nom", "nom", $nom, 1, "Nom", "",1));
$formulaireInfos->ajouterComposantTab();

$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerLabel("Prenom : "));
$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerInputTexte("prenom", "prenom", $prenom, 1, "Prenom", "",1));
$formulaireInfos->ajouterComposantTab();

$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerLabel("Fonction : "));
$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerInputTexte("Fonction", "Fonction", $libelleFonction, 1, "Fonction", "",1));
$formulaireInfos->ajouterComposantTab();

$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerLabel("Statut : "));
$formulaireInfos->ajouterComposantLigne($formulaireInfos->creerInputTexte("statut", "statut", $statut, 1, "Statut", "",1));
$formulaireInfos->ajouterComposantTab();


$formulaireInfos->creerFormulaire();
include_once 'vue/vueInformations.php' ;

