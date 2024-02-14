<?php


if(isset($_POST["ClubAjouter"])){
    $_SESSION['club']="0";

}

if(isset($_POST["ClubEnregistrer"])){

    $reponseSGBD=clubDAO::ajouter($_POST["nomClub"],$_POST["adresseClub"]);
    if($reponseSGBD){
        $_SESSION['club'] = $reponseSGBD;
    }
}


if(isset($_POST["ClubEnregistrerModif"])){

    $reponseSGBD=clubDAO::modifier($_SESSION['clubActif']->getIdClub(),$_POST["nomClub"],$_POST["adresseClub"]);
    if ($reponseSGBD){
        $_SESSION['listeClubs'] = new clubs(clubDAO::lesClubs());
    }
}


if(isset($_POST["ClubSupprimer"])){
    $reponseSGBD=clubDAO::supprimer($_SESSION['clubActif'] ->getIdClub());
    if ($reponseSGBD){
        $_SESSION['listeClubs'] = new clubs(clubDAO::lesClubs());
        $_SESSION['club']= $_SESSION['listeClubs']->premierClub();
    }

}

if(isset($_POST["ClubAnnuler"])){
    $_SESSION['club']= $_SESSION['listeClubs']->premierClub();
}

$_SESSION['listeClubs'] = new clubs(clubDAO::lesClubs());

if(isset($_GET['club'])){
	$_SESSION['club']= $_GET['club'];
}
else
{
	if(!isset($_SESSION['club'])){
		$_SESSION['club']="0";
	}
}

$menuClub = new Menu("menuClub");

/**
La liste des clubs ne se remplit pas j'ai verifier avec un vardump et je ne sais pas ou est l'erreur
var_dump($_SESSION['listeClubs']);
die();
 */
foreach ($_SESSION['listeClubs']->getClubs() as $unClub){
	$menuClub->ajouterComposant($menuClub->creerItemLien($unClub->getIdClub(),$unClub->getNomClub()));
}

$leMenuClub = $menuClub->creerMenuClub($_SESSION['club'],);

$_SESSION['clubActif'] = $_SESSION['listeClubs']->chercheClub($_SESSION['club']);


$formClub= new Formulaire("post","index.php","formClub","formClub");

if($_SESSION['club']!=0){

    if(isset($_POST["ClubModif"])) {
        $formClub->ajouterComposantLigne($formClub->creerLabel("Nom club: ", "labelClub"), 1);
        $formClub->ajouterComposantLigne($formClub->creerInputTexte("nomClub", "nomClub", $_SESSION['clubActif']->getNomClub(), "1", "", "0", "1"), 1);
        $formClub->ajouterComposantTab();
        $formClub->ajouterComposantLigne($formClub->creerLabel("Adresse club: ", "labelAdresse"), 1);
        $formClub->ajouterComposantLigne($formClub->creerInputTexte("adresseClub", "adresseClub", $_SESSION['clubActif']->getAdresseClub(), "1", "", "0"), 1);
        $formClub->ajouterComposantTab();
        $formClub->ajouterComposantLigne($formClub->creerInputSubmit("ClubEnregistrerModif", "ClubEnregistrerModif", "Enregistrer"), 1);
        $formClub->ajouterComposantLigne($formClub->creerInputSubmit("ClubAnnuler", "ClubAnnuler", "Annuler"), 1);
        $formClub->ajouterComposantTab();
    }
	else{
        $formClub->ajouterComposantLigne($formClub->creerLabel("Nom club: ", "labelClub"), 1);
        $formClub->ajouterComposantLigne($formClub->creerInputTexte("nomClub", "nomClub", $_SESSION['clubActif']->getNomClub() , "1" , "", "0") , 1 );
        $formClub->ajouterComposantTab();
        $formClub->ajouterComposantLigne($formClub->creerLabel("Adresse club: ", "labelAdresse"), 1);
        $formClub->ajouterComposantLigne($formClub->creerInputTexte("adresseClub", "adresseClub", $_SESSION['clubActif']->getAdresseClub() , "1" , "", "0") , 1 );
        $formClub->ajouterComposantTab();
        $formClub->ajouterComposantLigne($formClub->creerInputSubmit("ClubModif", "ClubModif", "Modifier"), 1);
        $formClub->ajouterComposantLigne($formClub->creerInputSubmit("ClubSupprimer", "ClubSupprimer", "Supprimer"), 1);
        $formClub->ajouterComposantLigne($formClub->creerInputSubmit("ClubAjouter", "ClubAjouter", "Ajouter"), 1);
        $formClub->ajouterComposantTab();
    }
}
else{
    $formClub->ajouterComposantLigne($formClub->creerLabel("Nom club: ", "labelClub"), 1);
    $formClub->ajouterComposantLigne($formClub->creerInputTexte("nomClub", "nomClub", $_SESSION['clubActif']->getNomClub() , "1" , "", "0") , 1 );
    $formClub->ajouterComposantTab();
    $formClub->ajouterComposantLigne($formClub->creerLabel("Adresse club: ", "labelAdresse"), 1);
    $formClub->ajouterComposantLigne($formClub->creerInputTexte("adresseClub", "adresseClub", $_SESSION['clubActif']->getAdresseClub() , "1" , "", "0") , 1 );
    $formClub->ajouterComposantTab();
    $formClub->ajouterComposantLigne($formClub->creerInputSubmit("ClubEnregistrer", "ClubEnregistrer", "Enregistrer"), 1);
    $formClub->ajouterComposantLigne($formClub->creerInputSubmit("ClubAnnuler", "ClubAnnuler", "Annuler"), 1);
    $formClub->ajouterComposantTab();

}
$formClub->creerFormulaire();

include_once 'vue/vueClubs.php';
