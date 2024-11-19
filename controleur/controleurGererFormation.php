<?php


/*****************************************************************************************************
 * Instancier un objet contenant la liste des Formations et le conserver dans une variable de session
 *****************************************************************************************************/
$_SESSION['listeFormations'] = new formations(formationDAO::lesFormations());


if(isset($_GET['formation'])){
    $_SESSION['formation']= $_GET['formation'];
}
else
{
    if(!isset($_SESSION['formation'])){
        $_SESSION['formation']="0";
    }
}

if(isset($_POST['submitAjouter'])){
    $_SESSION['formation']= 0;
}

if (isset($_POST['submitEnregistrer'])) {
    $dateOuvertInscriptions = !empty($_POST['dateOuvertInscriptions']) ? $_POST['dateOuvertInscriptions'] : null;
    $dateClotureInscriptions = !empty($_POST['dateClotureInscriptions']) ? $_POST['dateClotureInscriptions'] : null;


    if ($dateOuvertInscriptions === null) {

    } else {

        $nouvelleFormationId = formationDAO::enregistrerFormation($_POST['intitule'], $_POST['descriptif'], $_POST['duree'], $dateOuvertInscriptions, $dateClotureInscriptions, $_POST['effectifMax']);

        $_SESSION['listeFormations'] = new formations(formationDAO::lesFormations());

        $_SESSION['formation'] = $nouvelleFormationId;
    }
}


if(isset($_POST['submitSupprimer'])){
    formationDAO::supprimer($_SESSION['formation']);
    $_SESSION['listeFormations'] = new formations(formationDAO::lesFormations());
    $_SESSION['formation'] = "0" ;
}

if(isset($_POST['submitAnnuler'])){
    $_SESSION['formation']= $_GET['formation'];
}


if (isset($_POST['modifier_etat'])) {
    $formation_id = $_POST['formation_id'];
    $nouvel_etat = $_POST['etat_inscription_' . $formation_id];

    // Mettre à jour l'état de l'inscription avec la nouvelle valeur $nouvel_etat
    // Utiliser $formation_id pour identifier l'inscription à mettre à jour

    if (inscriptionDAO::mettreAJourEtatInscription($formation_id, $nouvel_etat)) {

        header("Location: index.php?m2lMP=gererFormation");
        exit();
    } else {

        echo "La mise à jour de l'état de l'inscription a échoué.";
    }
}




$menuFormation = new Menu("menuFormation");

foreach ($_SESSION['listeFormations']->getFormations() as $uneFormation){
    $menuFormation->ajouterComposant($menuFormation->creerItemLien($uneFormation->getIdForma(),$uneFormation->getIntitule()));
}

$leMenuFormations = $menuFormation->creerMenuFormation($_SESSION['formation']);

/*****************************************************************************************************
 * Récupérer la formation séléctionnée
 *****************************************************************************************************/

$formationActive = $_SESSION['listeFormations']->chercheFormation($_SESSION['formation']);


$formFormation = new Formulaire ("post", "index.php" , "formulaireFormation","formulaireFormation" );

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

    $formFormation->ajouterComposantLigne($formFormation->creerLabel("Date d'ouverture des inscriptions : ", "labelDateOuverture"));
    $formFormation->ajouterComposantLigne($formFormation->creerInputTexte("dateOuvertInscriptions", "dateOuvertInscriptions", $formationActive->getDateOuvertInscriptions(), "1", "", "1"));
    $formFormation->ajouterComposantTab();


    $formFormation->ajouterComposantLigne($formFormation->creerLabel("Date fermeture d'inscription :", "descriptif"));
    $formFormation->ajouterComposantLigne($formFormation->creerInputTexte("dateClotureInscriptions", "dateClotureInscriptions", $formationActive->getDateClotureInscriptions(), "1", "", "1"));
    $formFormation->ajouterComposantTab();

    $formFormation->ajouterComposantLigne($formFormation->creerInputSubmit('submitAjouter', 'submitAjouter', "Ajouter"));
    $formFormation->ajouterComposantTab();

    $formFormation->ajouterComposantLigne($formFormation->creerInputSubmit('submitSupprimer', 'submitSupprimer', "Supprimer"));
    $formFormation->ajouterComposantTab();
}else {

    $formFormation->ajouterComposantLigne($formFormation->creerLabel("Nom : ", "labelFormation"));
    $formFormation->ajouterComposantLigne($formFormation->creerInputTexte("intitule", "intitule", "", "", "","0"));
    $formFormation->ajouterComposantTab();

    $formFormation->ajouterComposantLigne($formFormation->creerLabel("Descriptif : ", "descriptif"));
    $formFormation->ajouterComposantLigne($formFormation->creerInputTexte("descriptif", "descriptif","", "", "","0"));
    $formFormation->ajouterComposantTab();

    $formFormation->ajouterComposantLigne($formFormation->creerLabel("Durée de la formation : ", "duree"));
    $formFormation->ajouterComposantLigne($formFormation->creerInputTexte("duree", "duree", "", "", "","0"));
    $formFormation->ajouterComposantTab();

    $formFormation->ajouterComposantLigne($formFormation->creerLabel("Date d'ouverture d'inscription (YYYY-MM-DD) : ", "descriptif"));
    $formFormation->ajouterComposantLigne($formFormation->creerInputTexte("dateOuvertInscriptions", "dateOuvertInscriptions","", "", "","0"));
    $formFormation->ajouterComposantTab();

    $formFormation->ajouterComposantLigne($formFormation->creerLabel("Date fermeture d'inscription (YYYY-MM-DD) :", "descriptif"));
    $formFormation->ajouterComposantLigne($formFormation->creerInputTexte("dateClotureInscriptions", "dateClotureInscriptions", "", "", "","0"));
    $formFormation->ajouterComposantTab();

    $formFormation->ajouterComposantLigne($formFormation->creerLabel("Effectif Max :", "descriptif"));
    $formFormation->ajouterComposantLigne($formFormation->creerInputTexte("effectifMax", "effectifMax", "", "", "","0"));
    $formFormation->ajouterComposantTab();


    $formFormation->ajouterComposantLigne($formFormation->creerInputSubmit('submitEnregistrer', 'submitEnregistrer', "Enregistrer"));
    $formFormation->ajouterComposantTab();
    $formFormation->ajouterComposantLigne($formFormation->creerInputSubmit('submitAnnuler', 'submitAnnuler', "Annuler"));
    $formFormation->ajouterComposantTab();

}







$formFormation->creerFormulaire();

require_once 'vue/vueGererFormation.php';