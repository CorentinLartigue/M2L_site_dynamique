<?php

$_SESSION['listeContrats'] = contratsDAO::mesContrats($_SESSION['identification']);
$formulaireContrats = new Formulaire('post', 'index.php', 'fContrats', 'fContrats');

$i = 0;
while($i != count($_SESSION['listeContrats'])) {
    $idContrat = $_SESSION['listeContrats'][$i]['idContrat'];
    $nom = $_SESSION['listeContrats'][$i]['nom'];
    $dateDebut = $_SESSION['listeContrats'][$i]['dateDebut'];
    $dateFin = $_SESSION['listeContrats'][$i]['dateFin'];
    $typeContrat = $_SESSION['listeContrats'][$i]['typeContrat'];
    $nbHeures = $_SESSION['listeContrats'][$i]['nbHeures'];


    $formulaireContrats->ajouterComposantLigne($formulaireContrats->creerLabel("Id du contrat : "));
    $formulaireContrats->ajouterComposantLigne($formulaireContrats->creerInputTexte("idContrat", "idContrat", $idContrat, 1, "Identifiant du contrat", "", 1));
    $formulaireContrats->ajouterComposantTab();

    $formulaireContrats->ajouterComposantLigne($formulaireContrats->creerLabel("Nom : "));
    $formulaireContrats->ajouterComposantLigne($formulaireContrats->creerInputTexte("nom", "nom", $nom, 1, "Nom sur le contrat", "", 1));
    $formulaireContrats->ajouterComposantTab();

    $formulaireContrats->ajouterComposantLigne($formulaireContrats->creerLabel("Date de début : "));
    $formulaireContrats->ajouterComposantLigne($formulaireContrats->creerInputTexte("dateDebut", "dateDebut", $dateDebut, 1, "Date du debut", "", 1));
    $formulaireContrats->ajouterComposantTab();

    $formulaireContrats->ajouterComposantLigne($formulaireContrats->creerLabel("Date de fin : "));
    $formulaireContrats->ajouterComposantLigne($formulaireContrats->creerInputTexte("dateFin", "dateFin", $dateFin, 1, "Date de fin", "", 1));
    $formulaireContrats->ajouterComposantTab();

    $formulaireContrats->ajouterComposantLigne($formulaireContrats->creerLabel("Type de contrat : "));
    $formulaireContrats->ajouterComposantLigne($formulaireContrats->creerInputTexte("typeContrat", "typeContrat", $typeContrat, 1, "Type de contrat", "", 1));
    $formulaireContrats->ajouterComposantTab();

    $formulaireContrats->ajouterComposantLigne($formulaireContrats->creerLabel("Nombre d'heures : "));
    $formulaireContrats->ajouterComposantLigne($formulaireContrats->creerInputTexte("nbHeures", "nbHeures", $nbHeures, 1, "Nombre d'heures", "", 1));
    $formulaireContrats->ajouterComposantTab();

    $i++;
}

$formulaireContrats->creerFormulaire();
include_once 'vue/vueContrats.php' ;

