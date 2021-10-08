<?php

class ResponsableDAO
{
    public static function SuppIntervenants($idUser){
        $requetePrepa = DBConnex::getInstance()->prepare("DELETE FROM Utilisateur where idUser=:idUser");
        $requetePrepa->bindParam(':idUser', $idUser);
        $requetePrepa->execute();
        $result = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public static function modifIntervenant($idUser, $nom, $prenom, $login, $statut, $typeUser)
    {
        //Met à jour les informations d'un intervenant
        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE Utilisateur SET nom=:nom , prenom=:prenom, nom=:nom , login=:login, statut=:statut , typeUser=:typeUser where idUser=:idUser");
        $requetePrepa->bindParam(':idUser', $idUser);
        $requetePrepa->bindParam(':nom', $nom);
        $requetePrepa->bindParam(':prenom', $prenom);
        $requetePrepa->bindParam(':login', $login);
        $requetePrepa->bindParam(':statut', $statut);
        $requetePrepa->bindParam(':typeUser', $typeUser);

        $requetePrepa->execute();
        $result = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public static function getInfoSalarie(){
        //Récupère toute les informations du salarié
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT Utilisateur.idUser, Contrat.idContrat, nom, prenom, statut, typeContrat, BulletinPDF 
        FROM Utilisateur, Contrat, Buletin 
        WHERE Utilisateur.idUser = Contrat.idUser 
        AND Contrat.idContrat = Buletin.idContrat 
        AND statut = 'salarié'");
        $requetePrepa->execute();
        $result = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    public static function modifContrat($idUser, $nom, $prenom, $statut, $typecontrat, $bulletinPDF, $idContrat){
        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE Utilisateur SET nom=:nom , prenom=:prenom, statut=:statut where idUser=:idUser");
        $requetePrepa->bindParam(':nom', $nom);
        $requetePrepa->bindParam(':prenom', $prenom);
        $requetePrepa->bindParam(':statut', $statut);
        $requetePrepa->bindParam(':idUser', $idUser);

        $requetePrepa->execute();
        
        $r = DBConnex::getInstance()->prepare("UPDATE Contrat SET typeContrat=:typeContrat where idUser=:idUser");
        $r->bindParam(':typeContrat', $typecontrat);
        $r->bindParam(':idUser', $idUser);

        $r->execute();

        $rq = DBConnex::getInstance()->prepare("UPDATE Buletin SET bulletinPDF=:bulletinPDF where idContrat=:idContrat");
        $rq->bindParam(':bulletinPDF', $bulletinPDF);
        $rq->bindParam(':idContrat', $idContrat);
        $rq->execute();
    }
}