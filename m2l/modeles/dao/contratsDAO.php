<?php

class contratsDAO
{
    public static function mesContrats($unLogin)
    {
        $requetePrepa = DBConnex::getInstance()->prepare("select idContrat,nom,dateDebut,dateFin,typeContrat,nbHeures from contrat join utilisateur on contrat.idUser = utilisateur.idUser where login = :login;");
        $requetePrepa->bindParam(":login", $unLogin);

        $requetePrepa->execute();

        $contrats = $requetePrepa->fetchAll();
        return $contrats;
    }

    public static function ajouterContrat($idUser, $dateDebut, $dateFin, $typeContrat, $nbHeures)
    {
        $id = uniqid();
        $requetePrepa = DBConnex::getInstance()->prepare("insert into contrat(idContrat, idUser, dateDebut, dateFin, typeContrat, nbHeures) VALUES (:idContrat,:idUser,:dateDebut,:dateFin,:typeContrat,:nbHeures);");

        $requetePrepa->bindParam(":idContrat", $id);
        $requetePrepa->bindParam(":idUser", $idUser);
        $requetePrepa->bindParam(":dateDebut", $dateDebut);
        $requetePrepa->bindParam(":dateFin", $dateFin);
        $requetePrepa->bindParam(":typeContrat", $typeContrat);
        $requetePrepa->bindParam(":nbHeures", $nbHeures);


        return $requetePrepa->execute();
    }

    public static function supprimerContrat($contrat)
    {
        $requetePrepa = DBConnex::getInstance()->prepare("delete from contrat where idContrat = :idContrat");
        $requetePrepa->bindParam(":idContrat", $contrat);

        return $requetePrepa->execute();
    }

    public static function lesContrats()
    {
        $requetePrepa = DBConnex::getInstance()->prepare("select * from contrat order by idContrat ");

        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
        return $liste;
    }

    public static function modifierContrat($idUser, $dateDebut, $dateFin, $typeContrat, $nbHeures, $contrat)
    {
        $requetePrepa = DBConnex::getInstance()->prepare("update contrat set idUser = :idUser, dateDebut = :dateDebut, dateFin = :dateFin, typeContrat = :typeContrat , nbHeures = :nbHeures where idContrat = :idContrat");

        $requetePrepa->bindParam(":idContrat", $contrat);
        $requetePrepa->bindParam(":idUser", $idUser);
        $requetePrepa->bindParam(":dateDebut", $dateDebut);
        $requetePrepa->bindParam(":dateFin", $dateFin);
        $requetePrepa->bindParam(":typeContrat", $typeContrat);
        $requetePrepa->bindParam(":nbHeures", $nbHeures);

        return $requetePrepa->execute();
    }

    public static function contenuContrat()
    {
        $requetePrepa = DBConnex::getInstance()->prepare("select idContrat,idUser,dateDebut,dateFin,typeContrat,nbHeures from contrat;");

        $requetePrepa->execute();

        $contenu = $requetePrepa->fetchAll();
        return $contenu;
    }

    public static function getNomUtilisateurByContrat($contratActif)
    {
        $idContrat = $contratActif->getIdContrat();
        $requetePrepa = DBConnex::getInstance()->prepare("select nom from utilisateur join contrat on contrat.idUser = utilisateur.idUser where idContrat = :idContrat;");
        $requetePrepa->bindParam(":idContrat", $idContrat);

        $requetePrepa->execute();
        $nomUser = $requetePrepa->fetch();
        return $nomUser[0];
    }

    public static function getIdUtilisateurByContrat($contratActif)
    {
        $idContrat = $contratActif->getIdContrat();
        $requetePrepa = DBConnex::getInstance()->prepare("select idUser from contrat where idContrat = :idContrat;");
        $requetePrepa->bindParam(":idContrat", $idContrat);

        $requetePrepa->execute();
        $idUser = $requetePrepa->fetch();
        return $idUser[0];
    }
}