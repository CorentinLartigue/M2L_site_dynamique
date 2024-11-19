<?php
$contexte = "EditClub";

if(isset($_POST["ClubEnregistrer"])){
    if(!empty($_POST["nomClub"]) && !empty($_POST["adresseClub"]) ) {
        $reponseSGBD=clubDAO::ajouter($_POST["nomClub"],$_POST["adresseClub"],$_POST["idLigue"]);
        if($reponseSGBD){
            $_SESSION['club'] = $reponseSGBD;
        }
    }
    else{
        $message = "Il faut remplir tous les champs pour ajouter un club ! Veuillez recommencé !";
        echo "<script>alert('" . $message . "');</script>";    
    }
}


if(isset($_POST["ClubEnregistrerModif"])){
    if(!empty($_POST["nomClub"]) && !empty($_POST["adresseClub"]) ) {
        $reponseSGBD=clubDAO::modifier($_SESSION['clubActif']->getIdClub(),$_POST["nomClub"],$_POST["adresseClub"],$_POST["idLigue"]);
        if ($reponseSGBD){
            $_SESSION['listeClubs'] = new clubs(clubDAO::lesClubs());
        }
    }
    else{
        $message = "Il faut remplir tous les champs pour ajouter un club ! Veuillez recommencé !";
        echo "<script>alert('" . $message . "');</script>";    
    }
}

if(isset($_POST["ClubSupprimer"])){
    clubDAO::supprimer($_SESSION['club']);
    $_SESSION['club']=0;

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

foreach ($_SESSION['listeClubs']->getClubs() as $unClub){
	$menuClub->ajouterComposant($menuClub->creerItemLien($unClub->getIdClub(),$unClub->getNomClub()));
}

$leMenuClub = $menuClub->creerMenuClub($_SESSION['club'],);

$_SESSION['clubActif'] = $_SESSION['listeClubs']->chercheClub($_SESSION['club']);


$formClub= new Formulaire("post","index.php","formClub","formClub");


if(isset($_POST["ClubAjouter"])){
    $formClub->ajouterComposantLigne($formClub->creerLabel("Nom club: ", "labelClub"), 1);
    $formClub->ajouterComposantLigne($formClub->creerInputTexte("nomClub", "nomClub","" , "", "0") , 1 );
    $formClub->ajouterComposantTab();
    $formClub->ajouterComposantLigne($formClub->creerLabel("Adresse club: ", "labelAdresse"), 1);
    $formClub->ajouterComposantLigne($formClub->creerInputTexte("adresseClub", "adresseClub", "", "", "0") , 1 );
    $formClub->ajouterComposantTab();
    $ligues = ligueDAO::lesligues(); 
    $optionsLigues = array();
    foreach ($ligues as $ligue) {
        $optionsLigues[$ligue->getIdLigue()] = $ligue->getNomLigue();
    }

    $formClub->ajouterComposantLigne($formClub->creerSelect("idLigue", "idLigue", "Ligue Affiliée: ", $optionsLigues,null), 1);
    $formClub->ajouterComposantTab();
    $formClub->ajouterComposantLigne($formClub->creerInputSubmit("ClubEnregistrer", "ClubEnregistrer", "Enregistrer"), 1);
    $formClub->ajouterComposantLigne($formClub->creerInputSubmit("ClubAnnuler", "ClubAnnuler", "Annuler"), 1);
    $formClub->ajouterComposantTab();
}
else{
    if($_SESSION['club']!=0){

        if(isset($_POST["ClubModif"])) {
            $formClub->ajouterComposantLigne($formClub->creerLabel("Nom club: ", "labelClub"), 1);
            $formClub->ajouterComposantLigne($formClub->creerInputTexte("nomClub", "nomClub", $_SESSION['clubActif']->getNomClub(),"", "0"), 1);
            $formClub->ajouterComposantTab();
            $formClub->ajouterComposantLigne($formClub->creerLabel("Adresse club: ", "labelAdresse"), 1);
            $formClub->ajouterComposantLigne($formClub->creerInputTexte("adresseClub", "adresseClub", $_SESSION['clubActif']->getAdresseClub(), "", "0"), 1);
            $formClub->ajouterComposantTab();
           
            $ligues = ligueDAO::lesligues(); 
            $optionsLigues = array();
            foreach ($ligues as $ligue) {
                $optionsLigues[$ligue->getIdLigue()] = $ligue->getNomLigue();
            }
            
            $formClub->ajouterComposantLigne($formClub->creerSelect("idLigue", "idLigue", "Ligue Affiliée: ", $optionsLigues,$_SESSION['clubActif']->getIdLigue()), 1);
            $formClub->ajouterComposantTab();
            

            $formClub->ajouterComposantLigne($formClub->creerInputSubmit("ClubEnregistrerModif", "ClubEnregistrerModif", "Enregistrer"), 1);
            $formClub->ajouterComposantLigne($formClub->creerInputSubmit("ClubAnnuler", "ClubAnnuler", "Annuler"), 1);
            $formClub->ajouterComposantTab();
        }
        else{
            $formClub->ajouterComposantLigne($formClub->creerLabel("Nom club: ", "labelClub"), 1);
            $formClub->ajouterComposantLigne($formClub->creerInputTexte("nomClub", "nomClub", $_SESSION['clubActif']->getNomClub() , "", "1") , 1 );
            $formClub->ajouterComposantTab();
            $formClub->ajouterComposantLigne($formClub->creerLabel("Adresse club: ", "labelAdresse"), 1);
            $formClub->ajouterComposantLigne($formClub->creerInputTexte("adresseClub", "adresseClub", $_SESSION['clubActif']->getAdresseClub() , "", "1") , 1 );
            $formClub->ajouterComposantTab();
            $formClub->ajouterComposantLigne($formClub->creerLabel("Ligue Affiliée: " , "labelLigue") , 1 );
            $formClub->ajouterComposantLigne($formClub->creerInputTexte("labelLigue", "labelLigue", ligueDAO::nomLigue($_SESSION['clubActif']->getIdLigue()) , "", "1") , 1 );
            $formClub->ajouterComposantTab();
            $formClub->ajouterComposantLigne($formClub->creerInputSubmit("ClubModif", "ClubModif", "Modifier"), 1);
            $formClub->ajouterComposantLigne($formClub->creerInputSubmit("ClubSupprimer", "ClubSupprimer", "Supprimer"), 1);
            $formClub->ajouterComposantTab();
        }
    }
    else{
       
        $formClub->ajouterComposantLigne($formClub->creerLabel("Veuillez sélectioner un club ! ", "label club"),1);
        $formClub->ajouterComposantTab();
    }

}
$formClub->creerFormulaire();

include_once 'vue/vueClubs.php';
