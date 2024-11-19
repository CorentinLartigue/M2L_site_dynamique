<?php
class inscriptionDAO{

    public static function lesInscriptions(){
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("select idUser,idForma,etatInscription from inscrire " );

        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($liste)){
            foreach($liste as $inscription){
                $uneInscription = new inscription(null,null,null);
                $uneInscription->hydrate($inscription);
                $result[] = $inscription;
            }
        }
        return $result;
    }

    public static function inscription($idUser, $idForma, $etatInscription ){

        $requetePrepa = DBConnex::getInstance()->prepare("insert into inscrire(idUser,idForma, etatInscription) VALUES (:idUser, :idForma, :etatInscriptionion )");

        $requetePrepa->bindParam(":idUser",$idUser);
        $requetePrepa->bindParam(":idForma",$idForma);
        $requetePrepa->bindParam(":etatInscriptionion",$etatInscription);


        $requetePrepa->execute();
        return DBConnex::getInstance()->lastInsertId();


    }

    public static function getInscriptionsByUser($idUser) {
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT F.idForma, F.intitule, F.descriptif, F.duree, F.dateOuvertInscriptions, F.dateClotureInscriptions, F.effectifMax, I.etatInscription FROM formation AS F JOIN inscrire AS I ON F.idForma = I.idForma WHERE I.idUser = :idUser");

        $requetePrepa->bindParam(":idUser", $idUser);
        $requetePrepa->execute();

        $result = [];
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($liste)) {
            foreach ($liste as $inscription) {
                $uneInscription = new inscription(null, null, null);
                $uneInscription->hydrate($inscription);
                $result[] = $uneInscription;
                 // Ajoutez cette ligne pour vérifier les données
            }
        }

        return $result;
    }

    public static function mettreAJourEtatInscription($formation_id, $nouvel_etat) {
        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE inscrire SET etatInscription = :nouvel_etat WHERE idForma = :formation_id");

        $requetePrepa->bindParam(":nouvel_etat", $nouvel_etat);
        $requetePrepa->bindParam(":formation_id", $formation_id);

        return $requetePrepa->execute();
    }




}