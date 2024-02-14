<?php
class ligueDAO{
    
    
       
    public static function lesligues(){
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT * FROM ligue");
       
        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC); 
        
        if(!empty($liste)){
            foreach($liste as $ligue){
                $uneLigue = new ligue(null,null);
                $uneLigue->hydrate($ligue);
                $result[] = $uneLigue;
            }
        }
        return $result;
    }

    
    public static function ajouter($nomLigue,$lienSite,$descriptif){
        $requetePrepa = DBConnex::getInstance()->prepare("INSERT INTO ligue(nomLigue,lienSite,descriptif) VALUES (:nomLigue,:lienSite,:descriptif)");
        $requetePrepa -> bindParam(':nomLigue', $nomLigue);
        $requetePrepa -> bindParam(':lienSite',$lienSite);
        $requetePrepa -> bindParam(':descriptif',$descriptif);
        $requetePrepa -> execute();
        DBConnex::getInstance()->lastInsertId();

    }
    
    public static function supprimer($idLigue){
        $requetePrepa = DBConnex::getInstance()->prepare("DELETE FROM ligue WHERE  idLigue=:idLigue");
        $requetePrepa -> bindParam(':idLigue', $idLigue);
        $requetePrepa -> execute();
     
    }

        
    public static function modifier($idLigue,$nomLigue,$lienSite,$descriptif){
        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE ligue SET nomLigue=:nomLigue,lienSite=:lienSite ,descriptif=:descriptif WHERE idLigue=:idLigue");
        $requetePrepa -> bindParam(':idLigue', $idLigue);
        $requetePrepa -> bindParam(':nomLigue', $nomLigue);
        $requetePrepa -> bindParam(':lienSite',$lienSite);
        $requetePrepa -> bindParam(':descriptif',$descriptif);

        return $requetePrepa -> execute();
     
    }

}