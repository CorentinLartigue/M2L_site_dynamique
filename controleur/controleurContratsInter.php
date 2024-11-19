<?php

if(isset($_POST['submitAjouter'])){
    $_SESSION['contrat']="0";
}

else if(isset($_POST['submitEnregistrer'])){
    contratsDAO::ajouterContrat($_POST['idUser'], $_POST['dateDebut'], $_POST['dateFin'], $_POST['typeContrat'], $_POST['nbHeures']);
}

else if(isset($_POST['submitSupprimer'])){
    contratsDAO::supprimerContrat($_SESSION['contrat']);
    $_SESSION['listeContrats'] = new contrats(contratsDAO::lesContrats());
    $_SESSION['contrat'] = "0";
}

else if(isset($_POST['submitModifier'])){
    $_SESSION['contrat']="0";
}

else if(isset($_POST['submitEnregistrerModif'])){
    contratsDAO::modifierContrat($_POST['idUser'], $_POST['dateDebut'], $_POST['dateFin'], $_POST['typeContrat'], $_POST['nbHeures'], $_SESSION['contrat']);
}

else if(isset($_POST['submitAnnuler'])) {
}

$_SESSION['listeContrats'] = new contrats(contratsDAO::contenuContrat());

/*****************************************************************************************************
 * Conserver dans une variable de session l'item actif du menu equipe
 *****************************************************************************************************/
if (isset($_GET['contrat'])) {
    $_SESSION['contrat'] = $_GET['contrat'];
} else {
    if (!isset($_SESSION['contrat'])) {
        $_SESSION['contrat'] = "0";
    }
}

/*****************************************************************************************************
 * Créer un menu vertical à partir de la liste des équipes
 *****************************************************************************************************/
$menuContrats = new Menu("menuContrats");


foreach ($_SESSION['listeContrats']->getContrats() as $unContrat) {
    $menuContrats->ajouterComposant($menuContrats->creerItemLien($unContrat->getIdContrat(), $unContrat->getIdContrat()));
}



/*****************************************************************************************************
 * Récupérer l'équipe sélectionnée
 *****************************************************************************************************/

$contratActif = $_SESSION['listeContrats']->chercheContrats($_SESSION['contrat']);
$formContrat = new Formulaire ("post", "index.php", "formulaireContrat", "formulaireContrat");

if ($_SESSION['contrat'] != "0") {

    $formContrat->ajouterComposantLigne($formContrat->creerLabel("Nom salarié : "));
    $formContrat->ajouterComposantLigne($formContrat->creerInputTexte("nom", "nom", contratsDAO::getNomUtilisateurByContrat($contratActif), 1, "", "",1));
    $formContrat->ajouterComposantTab();

    $formContrat->ajouterComposantLigne($formContrat->creerLabel("Date de début : "));
    $formContrat->ajouterComposantLigne($formContrat->creerInputTexte("dateDebut", "dateDebut", $contratActif->getDateDebut(), 1, "", "",1));
    $formContrat->ajouterComposantTab();

    $formContrat->ajouterComposantLigne($formContrat->creerLabel("Date de fin : "));
    $formContrat->ajouterComposantLigne($formContrat->creerInputTexte("dateFin", "dateFin", $contratActif->getDateFin(), 1, "", "",1));
    $formContrat->ajouterComposantTab();

    $formContrat->ajouterComposantLigne($formContrat->creerLabel("Type de contrat : "));
    $formContrat->ajouterComposantLigne($formContrat->creerInputTexte("typeContrat", "typeContrat", $contratActif->getTypeContrat(), 1, "", "",1));
    $formContrat->ajouterComposantTab();

    $formContrat->ajouterComposantLigne($formContrat->creerLabel("Nombre d'heures : "));
    $formContrat->ajouterComposantLigne($formContrat->creerInputTexte("nbHeures", "nbHeures", $contratActif->getNbHeures(), 1, "", "",1));
    $formContrat->ajouterComposantTab();


    $formContrat->ajouterComposantLigne($formContrat->creerInputSubmit('submitAjouter', 'submitAjouter', 'Ajouter'));
    $formContrat->ajouterComposantLigne($formContrat->creerInputSubmit('submitSupprimer', 'submitSupprimer', 'Suprrimer'));
    $formContrat->ajouterComposantLigne($formContrat->creerInputSubmit('submitModifier', 'submitModifier', 'Modifier'));

    $formContrat->ajouterComposantTab();
} else {
    if (isset($_POST['submitModifier'])) {
        $formContrat->ajouterComposantLigne($formContrat->creerLabel("ID Salarié : "));
        $formContrat->ajouterComposantLigne($formContrat->creerInputTexte("idUser", "idUser", contratsDAO::getIdUtilisateurByContrat($contratActif), 1, "", "",1));
        $formContrat->ajouterComposantTab();

        $formContrat->ajouterComposantLigne($formContrat->creerLabel("Date de début : "));
        $formContrat->ajouterComposantLigne($formContrat->creerInputTexte("dateDebut", "dateDebut", $contratActif->getDateDebut(), 1, "", "",1));
        $formContrat->ajouterComposantTab();

        $formContrat->ajouterComposantLigne($formContrat->creerLabel("Date de fin : "));
        $formContrat->ajouterComposantLigne($formContrat->creerInputTexte("dateFin", "dateFin", $contratActif->getDateFin(), 1, "", "",0));
        $formContrat->ajouterComposantTab();

        $formContrat->ajouterComposantLigne($formContrat->creerLabel("Type de contrat : "));
        $formContrat->ajouterComposantLigne($formContrat->creerInputTexte("typeContrat", "typeContrat", $contratActif->getTypeContrat(), 1, "", "",0));
        $formContrat->ajouterComposantTab();

        $formContrat->ajouterComposantLigne($formContrat->creerLabel("Nombre d'heures : "));
        $formContrat->ajouterComposantLigne($formContrat->creerInputTexte("nbHeures", "nbHeures", $contratActif->getNbHeures(), 1, "", "",0));
        $formContrat->ajouterComposantTab();

        $formContrat->ajouterComposantLigne($formContrat->creerInputSubmit('submitEnregistrerModif', 'submitEnregistrerModif', 'Enregistrer'));
        $formContrat->ajouterComposantLigne($formContrat->creerInputSubmit('submitAnnulerModif', 'submitAnnulerModif', 'Annuler'));
        $formContrat->ajouterComposantTab();
    } else if (isset($_POST['submitAjouter'])) {

        $formContrat->ajouterComposantLigne($formContrat->creerLabel("ID Salarie : "));
        $formContrat->ajouterComposantLigne($formContrat->creerInputTexte("idUser", "idUser", "", "", "", "", 0));
        $formContrat->ajouterComposantTab();

        $formContrat->ajouterComposantLigne($formContrat->creerLabel("Date de début : "));
        $formContrat->ajouterComposantLigne($formContrat->creerInputTexte("dateDebut", "dateDebut", "", "", "", "", 0));
        $formContrat->ajouterComposantTab();

        $formContrat->ajouterComposantLigne($formContrat->creerLabel("Date de fin : "));
        $formContrat->ajouterComposantLigne($formContrat->creerInputTexte("dateFin", "dateFin", "", "", "", "", 0));
        $formContrat->ajouterComposantTab();

        $formContrat->ajouterComposantLigne($formContrat->creerLabel("Type de contrat : "));
        $formContrat->ajouterComposantLigne($formContrat->creerInputTexte("typeContrat", "typeContrat", "", "", "", "", 0));
        $formContrat->ajouterComposantTab();

        $formContrat->ajouterComposantLigne($formContrat->creerLabel("Nombre d'heures : "));
        $formContrat->ajouterComposantLigne($formContrat->creerInputTexte("nbHeures", "nbHeures", "", "", "", "", 0));
        $formContrat->ajouterComposantTab();

        $formContrat->ajouterComposantLigne($formContrat->creerInputSubmit('submitEnregistrer', 'submitEnregistrer', 'Enregistrer'));
        $formContrat->ajouterComposantLigne($formContrat->creerInputSubmit('submitAnnuler', 'submitAnnuler', 'Annuler'));
        $formContrat->ajouterComposantTab();
    }
}


$formContrat->creerFormulaire();
$leMenuContrats = $menuContrats->creerMenuContrat($_SESSION['contrat']);


include_once 'vue/vueContratInter.php';

