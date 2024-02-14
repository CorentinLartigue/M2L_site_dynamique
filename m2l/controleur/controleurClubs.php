<?php


$_SESSION['listeClubs'] = new clubs(clubDAO::lesclubs());
/**
La liste des clubs ne se remplit pas j'ai verifier avec un vardump et je ne sais pas ou est l'erreur
var_dump($_SESSION['listeClubs']);
die();
 */
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


$clubActif = $_SESSION['listeClubs']->chercheClub($_SESSION['club']);

$formClub= new Formulaire("post","index.php","formClub","formClub");


if($_SESSION['club']!=0){

    $formClub->ajouterComposantLigne($formClub->creerLabel("Nom club: " , "labelClub") , 1 );
    $formClub->ajouterComposantLigne($formClub->creerInputTexte("nomClub", "nomClub", $clubActif ->getNomClub() , "1" , "", "1") , 1 );
    $formClub->ajouterComposantTab();
    $formClub->ajouterComposantLigne($formClub->creerLabel("Adresse club: " , "labelAdresse") , 1 );
    $formClub->ajouterComposantLigne($formClub->creerInputTexte("adresseClub", "adresseClub", $clubActif->getAdresseClub() , "1" , "", "1") , 1 );
    $formClub->ajouterComposantTab();

}
else{

    $formClub->ajouterComposantLigne($formClub->creerLabel("Veuiller selectioner un club! ", "label club"),1);
    $formClub->ajouterComposantTab();

}
$formClub->creerFormulaire();

include_once 'vue/vueClubs.php';
