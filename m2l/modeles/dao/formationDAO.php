<?php
class formationDAO
{

    public static function lesFormations()
    {
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("select idForma, intitule, descriptif, duree, dateOuvertInscriptions, dateClotureInscriptions, effectifMax from formation ");

        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($liste)) {
            foreach ($liste as $formation) {
                $uneFormation = new formation(null, null);
                $uneFormation->hydrate($formation);
                $result[] = $uneFormation;
            }
        }
        return $result;
    }


    public static function inscrireUtilisateurAFormation($idUser, $idForma, $etatInscription)
    {
        // Vérifier si l'inscription existe déjà
        $verificationPrepa = DBConnex::getInstance()->prepare("SELECT * FROM inscrire WHERE idUser = :idUser AND idForma = :idForma");
        $verificationPrepa->bindParam(":idUser", $idUser);
        $verificationPrepa->bindParam(":idForma", $idForma);
        $verificationPrepa->execute();

        $existingInscription = $verificationPrepa->fetch();

        if ($existingInscription) {

            return "Vous êtes déjà inscrit à cette formation.";
        } else {

            $requetePrepa = DBConnex::getInstance()->prepare("INSERT INTO inscrire (idUser, idForma, etatInscription) VALUES (:idUser, :idForma, :etatInscription)");
            $requetePrepa->bindParam(":idUser", $idUser);
            $requetePrepa->bindParam(":idForma", $idForma);
            $requetePrepa->bindParam(":etatInscription", $etatInscription);
            $requetePrepa->execute();
        }
    }




    public static function getFormationById($idFormation) {


        $requetePrepa = DBConnex::getInstance()->prepare("SELECT * FROM formation WHERE idForma = :idFormation");
        $requetePrepa->bindParam(":idFormation", $idFormation);
        $requetePrepa->execute();

        $formationData = $requetePrepa->fetch(PDO::FETCH_ASSOC);

        if ($formationData) {

            $formation = new formation($formationData['idForma'], $formationData['intitule']);


            $formation->setDescriptif($formationData['descriptif']);
            $formation->setDuree($formationData['duree']);

            return $formation;
        } else {

            return null;
        }
    }



    public static function enregistrerFormation($intitule, $descriptif, $duree, $dateOuvertInscriptions, $dateClotureInscriptions, $effectifMax) {
        // Génération d'un UUID
        $uuid = uniqid(); // Utilisation de la fonction uniqid pour générer un identifiant unique

        // Requête d'insertion avec l'UUID
        $query = "INSERT INTO `formation` ( `idForma`, `intitule`, `descriptif`, `duree`, `dateOuvertInscriptions`, `dateClotureInscriptions`, `effectifMax`)
              VALUES (:idForma, :intitule, :descriptif, :duree, :dateOuvertInscriptions, :dateClotureInscriptions, :effectifMax)";


        $stmt = DBConnex::getInstance()->prepare($query);
        $stmt->bindParam(':idForma', $uuid);
        $stmt->bindParam(':intitule', $intitule);
        $stmt->bindParam(':descriptif', $descriptif);
        $stmt->bindParam(':duree', $duree);
        $stmt->bindParam(':dateOuvertInscriptions', $dateOuvertInscriptions);
        $stmt->bindParam(':dateClotureInscriptions', $dateClotureInscriptions);
        $stmt->bindParam(':effectifMax', $effectifMax);

        if ($stmt->execute()) {
            return $uuid;
        } else {

            $errorInfo = $stmt->errorInfo();
            var_dump($errorInfo);
            return false;
        }
    }


    public static function supprimer($idForma) {
        // Supprimer d'abord les enregistrements dans la table INSCRIRE
        $suppressionInscriptionPrepa = DBConnex::getInstance()->prepare("DELETE FROM inscrire WHERE idForma = :idForma");
        $suppressionInscriptionPrepa->bindParam(":idForma", $idForma);
        $suppressionInscriptionPrepa->execute();

        // Ensuite, supprimez la formation
        $suppressionFormationPrepa = DBConnex::getInstance()->prepare("DELETE FROM formation WHERE idForma = :idForma");
        $suppressionFormationPrepa->bindParam(":idForma", $idForma);
        $suppressionFormationPrepa->execute();

    }

    public static function desinscrireUtilisateurDeFormation($idUser, $idForma) {
        $requetePrepa = DBConnex::getInstance()->prepare("DELETE FROM inscrire WHERE idUser = :idUser AND idForma = :idForma");
        $requetePrepa->bindParam(":idUser", $idUser);
        $requetePrepa->bindParam(":idForma", $idForma);
        $requetePrepa->execute();

    }


    public static function getEtatInscription($idUser, $idForma) {
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT etatInscription FROM inscrire WHERE idUser = :idUser AND idForma = :idForma");
        $requetePrepa->bindParam(":idUser", $idUser);
        $requetePrepa->bindParam(":idForma", $idForma);
        $requetePrepa->execute();

        $result = $requetePrepa->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['etatInscription'];
        } else {
            return "Non inscrit"; // ou une autre valeur par défaut
        }
    }

    public static function modifierFormation($formation_id, $nouvel_intitule, $nouveau_descriptif, $nouvelle_duree, $nouvelle_dateOuvertInscriptions, $nouvelle_dateClotureInscriptions, $nouvel_effectifMax) {
        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE formation 
        SET intitule = :intitule, descriptif = :descriptif, duree = :duree, dateOuvertInscriptions = :dateOuvertInscriptions, dateClotureInscriptions = :dateClotureInscriptions, effectifMax = :effectifMax 
        WHERE idForma = :formation_id");

        $requetePrepa->bindParam(":intitule", $nouvel_intitule);
        $requetePrepa->bindParam(":descriptif", $nouveau_descriptif);
        $requetePrepa->bindParam(":duree", $nouvelle_duree);
        $requetePrepa->bindParam(":dateOuvertInscriptions", $nouvelle_dateOuvertInscriptions);
        $requetePrepa->bindParam(":dateClotureInscriptions", $nouvelle_dateClotureInscriptions);
        $requetePrepa->bindParam(":effectifMax", $nouvel_effectifMax);
        $requetePrepa->bindParam(":formation_id", $formation_id);

        return $requetePrepa->execute();
    }














}