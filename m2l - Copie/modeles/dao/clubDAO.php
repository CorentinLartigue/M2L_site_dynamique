<?php
class clubDAO{
    
    
       
    public static function lesclubs(){
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT * FROM club");
       
        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC); 
        
        if(!empty($club)){
            foreach($liste as $club){
                $unClub = new club(null,null);
                $unClub->hydrate($club);
                $result[] = $unClub;
            }
        }
        return $result;
    }

    
    public static function ajouter($nomClub,$adresseClub){
        $requetePrepa = DBConnex::getInstance()->prepare("INSERT INTO club(nomClub,adresseClub) VALUES (:nomClub,:adresseClub)");
        $requetePrepa -> bindParam(':nomClub', $nomClub);
        $requetePrepa -> bindParam(':adresseClub',$adresseClub);
        $requetePrepa -> execute();
        DBConnex::getInstance()->lastInsertId();

    }
    
    public static function supprimer($idClub){
        $requetePrepa = DBConnex::getInstance()->prepare("DELETE FROM club WHERE  idClub=:idClub ");
        $requetePrepa -> bindParam(':idClub', $idClub);
        return $requetePrepa -> execute();
     
    }

        
    public static function modifier($idClub,$nomClub,$adresseClub){
        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE club SET nomClub=:nomClub,adresseClub=:adresseClub  WHERE idClub=:idClub;");
        $requetePrepa -> bindParam(':idClub', $idClub);
        $requetePrepa -> bindParam(':nomClub', $nomClub);
        $requetePrepa -> bindParam(':adresseClub',$adresseClub);

        return $requetePrepa -> execute();
     
    }

}