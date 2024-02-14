<?php

if(isset($_POST['submitAjouter'])){
    $_SESSION['intervenant']="0";
}

else if(isset($_POST['submitEnregistrer'])){
    utilisateurDAO::ajouterIntervenant($_POST['idLigue'], $_POST['idClub'], $_POST['nom'], $_POST['prenom'], $_POST['statut'], $_POST['login'], $_POST['mdp']);
}

else if(isset($_POST['submitSupprimer'])){
    utilisateurDAO::supprimerIntervenant($_SESSION['intervenant']);
    $_SESSION['listeIntervenants'] = new Intervenants(utilisateurDAO::lesIntervenants());
    $_SESSION['intervenant'] = "0";
}

else if(isset($_POST['submitModifier'])){
    $_SESSION['intervenant']="0";
}

else if(isset($_POST['submitEnregistrerModif'])){
    utilisateurDAO::modifierIntervenant($_POST['idLigue'], $_POST['idClub'], $_POST['nom'], $_POST['prenom'], $_POST['statut'], $_POST['login'], $_POST['mdp'], $_SESSION['intervenant']);
}

else if(isset($_POST['submitAnnuler'])) {
}

$_SESSION['listeIntervenants'] = new Intervenants(utilisateurDAO::infosInter());

/*****************************************************************************************************
 * Conserver dans une variable de session l'item actif du menu equipe
 *****************************************************************************************************/
if (isset($_GET['intervenant'])) {
    $_SESSION['intervenant'] = $_GET['intervenant'];
} else {
    if (!isset($_SESSION['intervenant'])) {
        $_SESSION['intervenant'] = "0";
    }
}

/*****************************************************************************************************
 * Créer un menu vertical à partir de la liste des équipes
 *****************************************************************************************************/
$menuIntervenant = new Menu("menuIntervenant");


foreach ($_SESSION['listeIntervenants']->getIntervenants() as $unIntervenant) {
    $menuIntervenant->ajouterComposant($menuIntervenant->creerItemLien($unIntervenant->getIdIntervenant(), $unIntervenant->getIdIntervenant()));
}



/*****************************************************************************************************
 * Récupérer l'équipe sélectionnée
 *****************************************************************************************************/

$intervenantActif = $_SESSION['listeIntervenants']->chercheIntervenant($_SESSION['intervenant']);
$formIntervenant = new Formulaire ("post", "index.php", "formulaireIntervenant", "formulaireIntervenant");

if ($_SESSION['intervenant'] != "0") {

    $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("ligue : "));
    $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("nomLigue", "nomLigue", utilisateurDAO::getNomLigueByIntervenant($intervenantActif), 1, "", "",1));
    $formIntervenant->ajouterComposantTab();

    $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("club : "));
    $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("nomCLub", "nomCLub", utilisateurDAO::getNomClubByIntervenant($intervenantActif), 1, "", "",1));
    $formIntervenant->ajouterComposantTab();

    $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("Nom : "));
    $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("nom", "nom", $intervenantActif->getNom(), 1, "", "",1));
    $formIntervenant->ajouterComposantTab();

    $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("Prenom : "));
    $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("prenom", "prenom", $intervenantActif->getPrenom(), 1, "", "",1));
    $formIntervenant->ajouterComposantTab();

    $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("Statut : "));
    $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("statut", "statut", $intervenantActif->getStatut(), 1, "", "",1));
    $formIntervenant->ajouterComposantTab();


    $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputSubmit('submitAjouter', 'submitAjouter', 'Ajouter'));
    $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputSubmit('submitSupprimer', 'submitSupprimer', 'Supprimer'));
    $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputSubmit('submitModifier', 'submitModifier', 'Modifier'));

    $formIntervenant->ajouterComposantTab();
} else {
    if (isset($_POST['submitModifier'])) {
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("ID ligue : "));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("idLigue", "idLigue", utilisateurDAO::getIdLigueByIntervenant($intervenantActif), 1, "", "",1));
        $formIntervenant->ajouterComposantTab();

        $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("ID club : "));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("idCLub", "idCLub", utilisateurDAO::getIdClubByIntervenant($intervenantActif), 1, "", "",1));
        $formIntervenant->ajouterComposantTab();

        $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("Nom : "));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("nom", "nom", $intervenantActif->getNom(), 1, "", "",0));
        $formIntervenant->ajouterComposantTab();

        $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("Prenom : "));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("prenom", "prenom", $intervenantActif->getPrenom(), 1, "", "",0));
        $formIntervenant->ajouterComposantTab();

        $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("Statut : "));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("statut", "statut", $intervenantActif->getStatut(), 1, "", "",0));
        $formIntervenant->ajouterComposantTab();

        $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("Login : "));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("login", "login", $intervenantActif->getLogin(), 1, "", "", 0));
        $formIntervenant->ajouterComposantTab();

        $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("MDP : "));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("mdp", "mdp", $intervenantActif->getMdp(), 1, "", "", 0));
        $formIntervenant->ajouterComposantTab();

        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputSubmit('submitEnregistrerModif', 'submitEnregistrerModif', 'Enregistrer'));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputSubmit('submitAnnulerModif', 'submitAnnulerModif', 'Annuler'));
        $formIntervenant->ajouterComposantTab();
    } else if (isset($_POST['submitAjouter'])) {

        $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("ID ligue : "));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("idLigue", "idLigue", "", "", "", "", 0));
        $formIntervenant->ajouterComposantTab();

        $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("ID club : "));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("idClub", "idClub", "", "", "", "", 0));
        $formIntervenant->ajouterComposantTab();

        $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("Nom : "));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("nom", "nom", "", "", "", "", 0));
        $formIntervenant->ajouterComposantTab();

        $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("Prenom : "));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("prenom", "prenom", "", "", "", "", 0));
        $formIntervenant->ajouterComposantTab();

        $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("Statut : "));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("statut", "statut", "", "", "", "", 0));
        $formIntervenant->ajouterComposantTab();

        $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("Login : "));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("login", "login", "", "", "", "", 0));
        $formIntervenant->ajouterComposantTab();

        $formIntervenant->ajouterComposantLigne($formIntervenant->creerLabel("MDP : "));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputTexte("mdp", "mdp", "", "", "", "", 0));
        $formIntervenant->ajouterComposantTab();


        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputSubmit('submitEnregistrer', 'submitEnregistrer', 'Enregistrer'));
        $formIntervenant->ajouterComposantLigne($formIntervenant->creerInputSubmit('submitAnnuler', 'submitAnnuler', 'Annuler'));
        $formIntervenant->ajouterComposantTab();
    }
}


$formIntervenant->creerFormulaire();
$leMenuIntervenants = $menuIntervenant->creerMenuIntervenant($_SESSION['intervenant']);


include_once 'vue/vueIntervenants.php';

