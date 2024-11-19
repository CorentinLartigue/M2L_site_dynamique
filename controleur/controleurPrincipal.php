<?php

$messageErreurConnex="";


if(isset($_POST['submitConnex'])){
    $identification=utilisateurDAO::verification($_POST['login'],$_POST['mdp']);
	if($identification){
		$_SESSION['identification']=$identification;
		$_SESSION['m2lMP']="accueil";
        $_SESSION['idFonct']=UtilisateurDAO::idFonctionUtilisateur($identification);
        $_SESSION['status']=UtilisateurDAO::statusUtilisateur($identification);
        $_SESSION['idUser']=UtilisateurDAO::idUserUtilisateur($identification);
	}
	else{
		$messageErreurConnex="Login ou password inconnu";
	}
}

else{
	if(!isset($_SESSION['identification'])){
		$_SESSION['identification']=false;
	}
}

if(isset($_GET['m2lMP'])){
	$_SESSION['m2lMP']= $_GET['m2lMP'];
}
else
{
	if(!isset($_SESSION['m2lMP'])){
		$_SESSION['m2lMP']="accueil";
	}
}




$m2lMP = new Menu("m2lMP");

if(isset($_SESSION['identification']) && $_SESSION['identification']){

	$m2lMP->ajouterComposant($m2lMP->creerItemLien("accueil", "Accueil"));
	$m2lMP->ajouterComposant($m2lMP->creerItemLien("services", "Services"));
	$m2lMP->ajouterComposant($m2lMP->creerItemLien("locaux", "Locaux"));

	$m2lMP->ajouterComposant($m2lMP->creerItemLien("informations", "Informations"));


	if($_SESSION['idFonct'] == 'F3'){
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("formations", "Formations"));
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("ligues", "Ligues"));
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("clubs", "Clubs"));
		if($_SESSION['status'] == 'salarie'){
			$m2lMP->ajouterComposant($m2lMP->creerItemLien("contrats", "Mes contrats"));
        }
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Déconnexion"));
    }

	else if($_SESSION['idFonct'] == 'F1'){

        $m2lMP->ajouterComposant($m2lMP->creerItemLien("liguesModif", "EditionLigues"));
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("clubsModif", "EditionClubs"));
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Déconnexion"));
	}

	else if($_SESSION['idFonct'] == 'F5'){

		$m2lMP->ajouterComposant($m2lMP->creerItemLien("contrats", "Mes contrats"));
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("formations", "Formations"));
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("gererFormation","Gérer Formations"));
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("ligues", "Ligues"));
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("clubs", "Clubs"));

        $m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Déconnexion"));
	}

	else if($_SESSION['idFonct'] == 'F4'){

		$m2lMP->ajouterComposant($m2lMP->creerItemLien("contrats", "Mes contrats"));
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("contratsInter", "contrats Intervenants"));
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("intervenants", "Intervenants"));
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("formations", "Formations"));
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("ligues", "Ligues"));
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("clubs", "Clubs"));

        $m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Déconnexion"));
	}

}else{

	$m2lMP->ajouterComposant($m2lMP->creerItemLien("accueil", "Accueil"));
	$m2lMP->ajouterComposant($m2lMP->creerItemLien("services", "Services"));
	$m2lMP->ajouterComposant($m2lMP->creerItemLien("locaux", "Locaux"));
    $m2lMP->ajouterComposant($m2lMP->creerItemLien("ligues", "Ligues"));
    $m2lMP->ajouterComposant($m2lMP->creerItemLien("clubs", "Clubs"));

	$m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Se connecter"));
}



$menuPrincipalM2L = $m2lMP->creerMenu($_SESSION['m2lMP'],'m2lMP');


include_once Dispatcher::dispatch($_SESSION['m2lMP']);






