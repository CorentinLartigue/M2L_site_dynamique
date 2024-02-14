<?php


if(isset($_POST["LigueAjouter"])){
    $_SESSION['ligue']="0";

}

if(isset($_POST["LigueEnregistrer"])){

    $reponseSGBD=ligueDAO::ajouter($_POST["nomLigue"],$_POST["site"],$_POST["descriptif"]);
    if($reponseSGBD){
        $_SESSION['ligue'] = $reponseSGBD;
    }
}


if(isset($_POST["LigueEnregistrerModif"])){

    $reponseSGBD=ligueDAO::modifier($_SESSION['ligueActive'] ->getIdLigue(),$_POST["nomLigue"],$_POST["site"],$_POST["descriptif"]);
    if ($reponseSGBD){
        $_SESSION['listeLigues'] = new ligues(ligueDAO::lesligues());
    }
}


if(isset($_POST["LigueSupprimer"])){
    ligueDAO::supprimer($_SESSION['ligue']);
    $_SESSION['listeLigues'] = new ligues(ligueDAO::lesligues());
    $_SESSION['ligue']= $_SESSION['listeLigues'] ->premierLigue();

}

if(isset($_POST["LigueAnnuler"])){
    $_SESSION['ligue']= $_GET['ligue'];
}

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

$leMenuLigue = $menuLigue->creerMenuLigue($_SESSION['ligue'],);


$_SESSION['ligueActive'] = $_SESSION['listeLigues']->chercheLigue($_SESSION['ligue']);


$formLigue= new Formulaire("post","index.php","formuLigue","formuLigue");

if($_SESSION['ligue']!=0){

    if(isset($_POST["LigueModif"])) {
        $formLigue->ajouterComposantLigne($formLigue->creerLabel("Nom ligue: ", "labelLigue"), 1);
        $formLigue->ajouterComposantLigne($formLigue->creerInputTexte("nomLigue", "nomLigue", $_SESSION['ligueActive']->getNomLigue(), "1", "", "0"), 1);
        $formLigue->ajouterComposantTab();
        $formLigue->ajouterComposantLigne($formLigue->creerLabel("Site: ", "labelSite"), 1);
        $formLigue->ajouterComposantLigne($formLigue->creerInputTexte("site", "site", $_SESSION['ligueActive']->getLienSite(), "1", "", "0"), 1);
        $formLigue->ajouterComposantTab();
        $formLigue->ajouterComposantLigne($formLigue->creerLabel("Descriptif: ", "labelDescriptif"), 1);
        $formLigue->ajouterComposantLigne($formLigue->creerInputTexte("descriptif", "descriptif", $_SESSION['ligueActive']->getDescriptif(), "1", "", "0"), 1);
        $formLigue->ajouterComposantTab();
        $formLigue->ajouterComposantLigne($formLigue->creerInputSubmit("LigueEnregistrerModif", "LigueEnregistrerModif", "Enregistrer"), 1);
        $formLigue->ajouterComposantLigne($formLigue->creerInputSubmit("LigueAnnuler", "LigueAnnuler", "Annuler"), 1);
        $formLigue->ajouterComposantTab();
    }
	else{
        $formLigue->ajouterComposantLigne($formLigue->creerLabel("Nom ligue: " , "labelLigue") , 1 );
        $formLigue->ajouterComposantLigne($formLigue->creerInputTexte("nomLigue", "nomLigue", $_SESSION['ligueActive'] ->getNomLigue() , "1" , "", "1") , 1 );
        $formLigue->ajouterComposantTab();
        $formLigue->ajouterComposantLigne($formLigue->creerLabel("Site: " , "labelSite") , 1 );
        $formLigue->ajouterComposantLigne($formLigue->creerInputTexte("site", "site", $_SESSION['ligueActive']->getLienSite() , "1" , "", "1") , 1 );
        $formLigue->ajouterComposantTab();
        $formLigue->ajouterComposantLigne($formLigue->creerLabel("Descriptif: " , "labelDescriptif") , 1 );
        $formLigue->ajouterComposantLigne($formLigue->creerInputTexte("descriptif", "descriptif", $_SESSION['ligueActive']->getDescriptif() , "1" , "", "1") , 1 );
        $formLigue->ajouterComposantTab();


        $formLigue->ajouterComposantLigne($formLigue->creerInputSubmit("LigueModif", "LigueModif", "Modifier"), 1);
        $formLigue->ajouterComposantLigne($formLigue->creerInputSubmit("LigueSupprimer", "EquipeSupprimer", "Supprimer"), 1);
        $formLigue->ajouterComposantLigne($formLigue->creerInputSubmit("LigueAjouter", "LigueAjouter", "Ajouter"), 1);
        $formLigue->ajouterComposantTab();
    }
}
else{

        $formLigue->ajouterComposantLigne($formLigue->creerLabel("Nom ligue: ", "labelLigue"), 1);
        $formLigue->ajouterComposantLigne($formLigue->creerInputTexte("nomLigue", "nomLigue", "", "1", "", "0"), 1);
        $formLigue->ajouterComposantTab();
        $formLigue->ajouterComposantLigne($formLigue->creerLabel("Site: ", "labelSite"), 1);
        $formLigue->ajouterComposantLigne($formLigue->creerInputTexte("site", "site", "", "1", "", "0"), 1);
        $formLigue->ajouterComposantTab();
        $formLigue->ajouterComposantLigne($formLigue->creerLabel("Descriptif: ", "labelDescriptif: "), 1);
        $formLigue->ajouterComposantLigne($formLigue->creerInputTexte("descriptif", "descriptif", "", "1", "", "0"), 1);
        $formLigue->ajouterComposantTab();
        $formLigue->ajouterComposantLigne($formLigue->creerInputSubmit("LigueEnregistrer", "LigueEnregistrer", "Enregistrer"), 1);
        $formLigue->ajouterComposantLigne($formLigue->creerInputSubmit("LigueAnnuler", "LigueAnnuler", "Annuler"), 1);
        $formLigue->ajouterComposantTab();

}
$formLigue->creerFormulaire();

include_once 'vue/vueLigues.php';
