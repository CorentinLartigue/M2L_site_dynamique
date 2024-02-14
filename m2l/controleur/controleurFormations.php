<?php

/*****************************************************************************************************
 * Instancier un objet contenant la liste des Formations et le conserver dans une variable de session
 *****************************************************************************************************/
$_SESSION['listeFormations'] = new formations(formationDAO::lesFormations());
$_SESSION['listeInscriptions'] = new inscriptions(inscriptionDAO::lesInscriptions());

if(isset($_GET['formation'])){
    $_SESSION['formation']= $_GET['formation'];
}
else
{
    if(!isset($_SESSION['formation'])){
        $_SESSION['formation']="0";
    }
}

if (!isset($_SESSION['inscription'])) {
    $_SESSION['inscription'] = "0";
}

$message = "";

if (isset($_POST['submitInscription'])) {

    $idUser = $_SESSION['idUser'];


    $idForma = $_SESSION['formation'];


    $message = formationDAO::inscrireUtilisateurAFormation($idUser, $idForma, 'inscrit');

    if (is_string($message)) {

        $message = $message ;
    } else {

        $message = "Inscription réussie!";
    }

}
if (isset($_GET['details'])) {
    $_SESSION['formation'] = $_GET['details'];
}

$idUser = $_SESSION['idUser'];
$idForma = $_SESSION['formation'];



if(isset($_POST['submitDesinscription'])){
    formationDAO::desinscrireUtilisateurDeFormation($idUser, $idForma);
    $_SESSION['listeInscriptions'] = new inscriptions(inscriptionDAO::lesInscriptions());
    $_SESSION['inscription'] = "0" ;
}



/***************************************************************************************************
 * Créer un menu vertical à partir de la liste des Formations
 *****************************************************************************************************/

$menuFormation = new Menu("menuFormation");

foreach ($_SESSION['listeFormations']->getFormations() as $uneFormation){
    $menuFormation->ajouterComposant($menuFormation->creerItemLien($uneFormation->getIdForma(),$uneFormation->getIntitule()));
}

$leMenuFormations = $menuFormation->creerMenuFormation($_SESSION['formation']);




$idUser = $_SESSION['idUser'];


$inscriptions = inscriptionDAO::getInscriptionsByUser($idUser);


$menuInscriptions = new Menu("menuInscriptions");

foreach ($inscriptions as $inscription) {
    $formation = $inscription->getIdForma();
    $menuInscriptions->ajouterComposant($menuInscriptions->creerItemLien($formation, $formation));
}

$leMenuInscriptions = $menuInscriptions->creerMenuFormation($_SESSION['inscription']);




/*****************************************************************************************************
 * Récupérer la formation séléctionnée
 *****************************************************************************************************/

$formationActive = $_SESSION['listeFormations']->chercheFormation($_SESSION['formation']);

$formFormation = new Formulaire("post", "index.php", "formulaireFormation", "formulaireFormation");


if ($_SESSION['formation']!=0) {


    $formFormation->ajouterComposantLigne($formFormation->creerLabel("Nom : ", "labelFormation"));
    $formFormation->ajouterComposantLigne($formFormation->creerInputTexte("intitule", "intitule", $formationActive->getIntitule(), "1", "", "1"));
    $formFormation->ajouterComposantTab();

    $formFormation->ajouterComposantLigne($formFormation->creerLabel("Descriptif : ", "descriptif"));
    $formFormation->ajouterComposantLigne($formFormation->creerInputTexte("descriptif", "descriptif", $formationActive->getDescriptif(), "1", "", "1"));
    $formFormation->ajouterComposantTab();

    $formFormation->ajouterComposantLigne($formFormation->creerLabel("Durée de la formation : ", "duree"));
    $formFormation->ajouterComposantLigne($formFormation->creerInputTexte("duree", "duree", $formationActive->getDuree(), "1", "", "1"));
    $formFormation->ajouterComposantTab();

    $formFormation->ajouterComposantLigne($formFormation->creerLabel("Ouvert le : ", "descriptif"));
    $formFormation->ajouterComposantLigne($formFormation->creerInputTexte("DateOuvertInscriptions", "DateOuvertInscriptions", $formationActive->getDateOuvertInscriptions(), "1", "", "1"));
    $formFormation->ajouterComposantTab();

    $formFormation->ajouterComposantLigne($formFormation->creerLabel("Ferme le :", "descriptif"));
    $formFormation->ajouterComposantLigne($formFormation->creerInputTexte("ferme", "ferme", $formationActive->getDateClotureInscriptions(), "1", "", "1"));
    $formFormation->ajouterComposantTab();

    $formFormation->ajouterComposantLigne($formFormation->creerInputSubmit('submitInscription', 'submitInscription', "Inscription"));
    $formFormation->ajouterComposantTab();

}




$formFormation->creerFormulaire();


require_once 'vue/vueFormation.php';
