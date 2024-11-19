<?php
class clubDAO{
    
    
       
    public static function lesclubs(){
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT * FROM club");
       
        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC); 
        
        if(!empty($liste)){
            foreach($liste as $club){
                $unClub = new club(null,null,null);
                $unClub->hydrate($club);
                $result[] = $unClub;
            }
        }
        return $result;
    }
    
    public static function ajouter($nomClub,$adresseClub,$idLigue){
        $requetePrepa = DBConnex::getInstance()->prepare("INSERT INTO club(nomClub,adresseClub,idLigue) VALUES (:nomClub,:adresseClub,:idLigue)");
        $requetePrepa -> bindParam(':nomClub', $nomClub);
        $requetePrepa -> bindParam(':adresseClub',$adresseClub);
        $requetePrepa -> bindParam(':idLigue',$idLigue);
        $requetePrepa -> execute();
        DBConnex::getInstance()->lastInsertId();

    }
    
    public static function supprimer($idClub){
        $requetePrepa = DBConnex::getInstance()->prepare("DELETE FROM club WHERE  idClub=:idClub ");
        $requetePrepa -> bindParam(':idClub', $idClub);
        return $requetePrepa -> execute();
     
    }

        
    public static function modifier($idClub,$nomClub,$adresseClub,$idLigue){
        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE club SET nomClub=:nomClub,adresseClub=:adresseClub,idLigue=:idLigue  WHERE idClub=:idClub;");
        $requetePrepa -> bindParam(':idClub', $idClub);
        $requetePrepa -> bindParam(':nomClub', $nomClub);
        $requetePrepa -> bindParam(':adresseClub',$adresseClub);
        $requetePrepa -> bindParam(':idLigue',$idLigue);

        return $requetePrepa -> execute();
     
    }


    public static function clubsDeLaLigue($idLigue){
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT * FROM club WHERE idLigue= :idLigue");
        $requetePrepa -> bindParam(':idLigue',$idLigue);
        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC); 
        
        if(!empty($liste)){
            foreach($liste as $club){
                $unClub = new club(null,null,null);
                $unClub->hydrate($club);
                $result[] = $unClub;
            }
        }
        return $result;
    }

}