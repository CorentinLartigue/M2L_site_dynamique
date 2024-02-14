<?php
class utilisateurDAO
{

    public static function verification($unLogin, $unMdp)
    {

        $requetePrepa = DBConnex::getInstance()->prepare("select login  from utilisateur where login = :login and  mdp = :mdp");
        $requetePrepa->bindParam(":login", $unLogin);
        $requetePrepa->bindParam(":mdp", $unMdp);

        $requetePrepa->execute();

        $login = $requetePrepa->fetch();
        return $login[0];
    }

    public static function lesIntervenants()
    {
        $requetePrepa = DBConnex::getInstance()->prepare("select * from utilisateur where idFonct = '3' order by nom ");

        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
        return $liste;
    }

    public static function idFonctionUtilisateur($unLogin)
    {

        $requetePrepa = DBConnex::getInstance()->prepare("select idFonct from utilisateur where login = :login");
        $requetePrepa->bindParam(":login", $unLogin);

        $requetePrepa->execute();

        $idFonct = $requetePrepa->fetch();
        return $idFonct[0];
    }

    public static function statusUtilisateur($unLogin)
    {

        $requetePrepa = DBConnex::getInstance()->prepare("select status from utilisateur where login = :login");
        $requetePrepa->bindParam(":login", $unLogin);

        $requetePrepa->execute();

        $status = $requetePrepa->fetch();
        return $status[0];
    }

    public static function infosInter()
    {
        $requetePrepa = DBConnex::getInstance()->prepare("select idUser,idLigue,idClub,nom,prenom,idFonct,status from utilisateur where idFonct = 'F3';");

        $requetePrepa->execute();


        $infos = $requetePrepa->fetchAll();
        return $infos;
    }


    public static function idUserUtilisateur($unLogin){

        $requetePrepa = DBConnex::getInstance()->prepare("select idUser from utilisateur where login = :login");
        $requetePrepa->bindParam( ":login", $unLogin);

        $requetePrepa->execute();

        $idUser  = $requetePrepa->fetch();
        return $idUser[0];
    }
    public static function getUtilisateurs()
    {
        $result = [];

        try {
            $conn = DBConnex::getInstance(); // Assurez-vous que votre connexion à la base de données est correcte
            $query = "SELECT * FROM utilisateur"; // Remplacez par votre requête SQL

            $stmt = $conn->prepare($query);
            $stmt->execute();
            $usersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($usersData as $userData) {
                $utilisateur = new utilisateur(null); // Créez un objet utilisateur (ajustez le constructeur si nécessaire)

                // Hydratez l'objet utilisateur avec les données de la base de données
                $utilisateur->setIdUser($userData['idUser']);
                $utilisateur->setNom($userData['nom']);
                $utilisateur->setPrenom($userData['prenom']);
                // Hydratez d'autres propriétés ici

                $result[] = $utilisateur;
            }
        } catch (PDOException $e) {
            // Gérez les erreurs de la base de données ici
            echo "Erreur de base de données : " . $e->getMessage();
        }

        return $result;}

    public static function mesInfos($unLogin)
    {
        $requetePrepa = DBConnex::getInstance()->prepare("select nomLigue,nomClub,nom,prenom,libelle,status from utilisateur join fonction on fonction.idFonct = utilisateur.idFonct join ligue on ligue.idLigue = utilisateur.idLigue join club on club.idClub = utilisateur.idClub where login = :login;");
        $requetePrepa->bindParam(":login", $unLogin);

        $requetePrepa->execute();

        $infos = $requetePrepa->fetchAll();
        return $infos;
    }

    public static function ajouterIntervenant($idLigue, $idClub, $nom, $prenom, $status, $login, $mdp)
    {
        $id = uniqid();
        $requetePrepa = DBConnex::getInstance()->prepare("insert into utilisateur(idUser, idLigue, idClub, nom, prenom, idFonct, status, login, mdp) VALUES (:idIntervenant,:idLigue,:idClub,:nom,:prenom,'F3',:status,:login,:mdp);");

        $requetePrepa->bindParam(":idIntervenant", $id);
        $requetePrepa->bindParam(":idLigue", $idLigue);
        $requetePrepa->bindParam(":idClub", $idClub);
        $requetePrepa->bindParam(":nom", $nom);
        $requetePrepa->bindParam(":prenom", $prenom);
        $requetePrepa->bindParam(":status", $status);
        $requetePrepa->bindParam(":login", $login);
        $requetePrepa->bindParam(":mdp", $mdp);


        return $requetePrepa->execute();
    }

    public static function supprimerIntervenant($intervenant){
        $requetePrepa = DBConnex::getInstance()->prepare("delete from utilisateur where idUser = :idIntervenant");
        $requetePrepa->bindParam(":idIntervenant", $intervenant);

        return $requetePrepa->execute();
    }


    public static function modifierIntervenant($idLigue, $idClub, $nom, $prenom, $status, $login, $mdp, $intervenant)
    {
        $requetePrepa = DBConnex::getInstance()->prepare("update utilisateur set idLigue = :idLigue, idClub = :idClub, nom = :nom, prenom = :prenom , status = :status, login = :login, mdp = :mdp where idUser = :idIntervenant");

        $requetePrepa->bindParam(":idIntervenant", $intervenant);
        $requetePrepa->bindParam(":idLigue", $idLigue);
        $requetePrepa->bindParam(":idClub", $idClub);
        $requetePrepa->bindParam(":nom", $nom);
        $requetePrepa->bindParam(":prenom", $prenom);
        $requetePrepa->bindParam(":status", $status);
        $requetePrepa->bindParam(":login", $login);
        $requetePrepa->bindParam(":mdp", $mdp);

        return $requetePrepa->execute();
    }

    public static function getIdClubByIntervenant($intervenant){
        $idIntervenant = $intervenant->getIdIntervenant();
        $requetePrepa = DBConnex::getInstance()->prepare("select idClub from utilisateur where idUser = :idIntervenant;");
        $requetePrepa->bindParam(":idIntervenant", $idIntervenant);

        $requetePrepa->execute();
        $idClub = $requetePrepa->fetch();
        return $idClub[0];
    }

    public static function getIdLigueByIntervenant($intervenant){
        $idIntervenant = $intervenant->getIdIntervenant();
        $requetePrepa = DBConnex::getInstance()->prepare("select idLigue from utilisateur where idUser = :idIntervenant;");
        $requetePrepa->bindParam(":idIntervenant", $idIntervenant);

        $requetePrepa->execute();
        $idClub = $requetePrepa->fetch();
        return $idClub[0];
    }

    public static function getNomClubByIntervenant($intervenant){
        $idIntervenant = $intervenant->getIdIntervenant();
        $requetePrepa = DBConnex::getInstance()->prepare("select nomClub from club join utilisateur on club.idClub = utilisateur.idClub where idUser = :idIntervenant;");
        $requetePrepa->bindParam(":idIntervenant", $idIntervenant);

        $requetePrepa->execute();
        $nomClub = $requetePrepa->fetch();
        return $nomClub[0];
    }

    public static function getNomLigueByIntervenant($intervenant){
        $idIntervenant = $intervenant->getIdIntervenant();
        $requetePrepa = DBConnex::getInstance()->prepare("select nomLigue from ligue join utilisateur on ligue.idLigue = utilisateur.idLigue where idUser = :idIntervenant;");
        $requetePrepa->bindParam(":idIntervenant", $idIntervenant);

        $requetePrepa->execute();
        $nomLigue = $requetePrepa->fetch();
        return $nomLigue[0];
    }
}