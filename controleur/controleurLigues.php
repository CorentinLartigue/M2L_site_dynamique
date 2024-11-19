<?php
$contexte = "Ligue";
$_SESSION['listeLigues'] = new ligues(ligueDAO::lesligues());

if(isset($_GET['ligue'])){
    $_SESSION['ligue']= $_GET['ligue'];
}
else
{
    if(!isset($_SESSION['ligue'])){
        $_SESSION['ligue']="0";
    }
}

$menuLigue = new Menu("menuLigue");


foreach ($_SESSION['listeLigues']->getLigues() as $uneLigue){
    $menuLigue->ajouterComposant($menuLigue->creerItemLien($uneLigue->getIdLigue(),$uneLigue->getNomLigue()));
}

$leMenuLigue = $menuLigue->creerMenuLigue($_SESSION['ligue']);

$_SESSION['ligueActive'] = $_SESSION['listeLigues']->chercheLigue($_SESSION['ligue']);

$formLigue= new Formulaire("post","index.php","formuLigue","formuLigue");

if($_SESSION['ligue'] != 0){
    $clubsDeLaLigue = clubDAO::clubsDeLaLigue($_SESSION['ligue']);
    $_SESSION['clubsDeLaLigue'] = $clubsDeLaLigue;
}



if($_SESSION['ligue']!=0){

    $formLigue->ajouterComposantLigne($formLigue->creerLabel("Nom ligue: " , "labelLigue") , 1 );
    $formLigue->ajouterComposantLigne($formLigue->creerInputTexte("nomLigue", "nomLigue", $_SESSION['ligueActive'] ->getNomLigue() , "", "1") , 1 );
    $formLigue->ajouterComposantTab();
    $formLigue->ajouterComposantLigne($formLigue->creerLabel("Site: " , "labelSite") , 1 );
    $formLigue->ajouterComposantLigne($formLigue->creerInputTexte("site", "site", $_SESSION['ligueActive']->getLienSite() , "", "1") , 1 );
    $formLigue->ajouterComposantTab();
    $formLigue->ajouterComposantLigne($formLigue->creerLabel("Descriptif: " , "labelDescriptif") , 1 );
    $formLigue->ajouterComposantLigne($formLigue->creerInputTexte("descriptif", "descriptif", htmlspecialchars($_SESSION['ligueActive']->getDescriptif())  , "", "1") , 1 );
    $formLigue->ajouterComposantTab();

}
else{

    $formLigue->ajouterComposantLigne($formLigue->creerLabel("Veuillez sélectioner une ligue ! ", "label ligue"),1);
    $formLigue->ajouterComposantTab();

}
$formLigue->creerFormulaire();

include_once 'vue/vueLigues.php';
