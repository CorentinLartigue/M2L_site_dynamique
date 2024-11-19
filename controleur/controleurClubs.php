<?php
$contexte = "Club";

$_SESSION['listeClubs'] = new clubs(clubDAO::lesclubs());

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


foreach ($_SESSION['listeClubs']->getClubs() as $unClub){
    $menuClub->ajouterComposant($menuClub->creerItemLien($unClub->getIdClub(),$unClub->getNomClub()));
}

$leMenuClub = $menuClub->creerMenuClub($_SESSION['club']);

$_SESSION['clubActif'] = $_SESSION['listeClubs']->chercheClub($_SESSION['club']);

$formClub= new Formulaire("post","index.php","formClub","formClub");


if($_SESSION['club']!=0){

    $formClub->ajouterComposantLigne($formClub->creerLabel("Nom club: " , "labelClub") , 1 );
    $formClub->ajouterComposantLigne($formClub->creerInputTexte("nomClub", "nomClub", $_SESSION['clubActif'] ->getNomClub() , "", "1") , 1 );
    $formClub->ajouterComposantTab();
    $formClub->ajouterComposantLigne($formClub->creerLabel("Adresse club: " , "labelAdresse") , 1 );
    $formClub->ajouterComposantLigne($formClub->creerInputTexte("adresseClub", "adresseClub", $_SESSION['clubActif']->getAdresseClub() , "", "1") , 1 );
    $formClub->ajouterComposantTab();
    $formClub->ajouterComposantLigne($formClub->creerLabel("Nom ligue: " , "labelLigue") , 1 );
    $formClub->ajouterComposantLigne($formClub->creerInputTexte("labelLigue", "labelLigue", ligueDAO::nomLigue($_SESSION['clubActif']->getIdLigue()) , "", "1") , 1 );
    $formClub->ajouterComposantTab();

}
else{

    $formClub->ajouterComposantLigne($formClub->creerLabel("Veuillez sélectioner un club ! ", "label club"),1);
    $formClub->ajouterComposantTab();

}
$formClub->creerFormulaire();

include_once 'vue/vueClubs.php';
