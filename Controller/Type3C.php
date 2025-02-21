<?php
require_once "configg.php";

class eventC {
    
    public function afficherType() {
        $sql="SELECT * FROM evenement";
        $db=Config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
    }

    public function chercheridTypeInst($id) {
        $sql="SELECT * FROM evenement where id=:id";
        $db=Config::getConnexion();
        try{
            $query=$db->prepare($sql);
        $query->execute(['id' =>$id]);
        $liste=$query->fetch();
        return $liste;
        } 
        catch (PDOException $e) {
            $e->getMessage();
        }
    }

     public function ajouterTypeInst($Type) {
        $sql = "INSERT INTO evenement (desc_eve,nom,directeur,prix_event,photo) values (:desc_eve,:nom,:directeur,:prix_event,:photo)" ;
        try{
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->execute([
            'desc_eve'=>$Type->getdesceveType(),
            'nom'=>$Type->getNomType(),
            'directeur'=>$Type->getdirecteurType(),
            'prix_event'=>$Type->getprixeventtype(),
            'photo'=>$Type->getPhotoType()

        ]);
        }
        catch (PDOException $e) {
            $e->getMessage();
    }
    } 

     public function supprimerTypeInst($id) {
        try {
            $db=config::getConnexion();
            $query=$db->prepare("DELETE FROM evenement WHERE id=:id");
            $query->execute(['id'=>$id]);
        }
        catch (PDOException $e) {
            $e->getMessage();
        }
    }

     public function modifierTypeInst($Type,$id) {
        try {
            $sql="UPDATE evenement SET desc_eve=:desc_eve,nom=:nom,directeur=:directeur,prix_event=:prix_event,photo=:photo WHERE id=:id";
            $db=config::getConnexion();
            $query=$db->prepare($sql);
            $query->execute([
            'id'=>$id,
            'desc_eve'=>$Type->getdesceveType(),
            'nom'=>$Type->getNomType(),
            'directeur'=>$Type->getdirecteurType(),
            'prix_event'=>$Type->getprixeventType(),
            'photo'=>$Type->getPhotoType()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function chercherTypeInst($nom) {
        $sql="SELECT * FROM evenement where nom='$nom'";
        $db=Config::getConnexion();
        try{
        $liste = $db->query($sql);
        return $liste;
        } 
        catch (PDOException $e) {
            $e->getMessage();
        }
    } 

    function rechercherType($str){
        $sql="SELECT * FROM evenement where nom like '".$str."%' or directeur like '".$str."%' or id like '".$str."%' ";
        $db = config::getConnexion();
        try{
            $liste=$db->query($sql);
            return $liste;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }


}
function affichercartetri($cc)
    {
        
        $sql="SELECT * FROM evenement ORDER BY $cc ASC";

        $db = config::getConnexion();
        try
        {
            $list=$db->query($sql);
            return $list;
        }
        catch (Exception $e)
        {
            die('Erreur: '.$e->getMessage());
        }
    }
?>