<?php


if(!isset($_SESSION['identification']) || !$_SESSION['identification']){
    $messageErreurConnex="";

	$formulaireConnexion = new Formulaire('post', 'index.php', 'fConnexion', 'fConnexion');
	
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabel('Identifiant :'));
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputTexte('login', 'login', '', 'Entrez votre identifiant', 0));
	$formulaireConnexion->ajouterComposantTab();

	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabel('Mot de Passe :'));
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputMdp('mdp', 'mdp',  '', 'Entrez votre mot de passe', 0));
	$formulaireConnexion->ajouterComposantTab();

	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion-> creerInputSubmit('submitConnex', 'submitConnex', 'Valider'));
	$formulaireConnexion->ajouterComposantTab();

	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerMessage($messageErreurConnex));
	$formulaireConnexion->ajouterComposantTab();
	
	$formulaireConnexion->creerFormulaire();

	require_once 'vue/vueConnexion.php' ;

}
else{
	$_SESSION['identification']=[];
	$_SESSION['m2lMP']="accueil";
	header('location: index.php');
}