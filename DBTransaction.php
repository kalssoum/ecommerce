<?php
    class DBTransaction{
        public $database;

        public function __construct(){
            if ($this->database == null) {
                $urlDB = "mysql:host=localhost;dbname=ecommerce";
                $username="root";
                $password="";
                $this->database = new PDO($urlDB,$username,$password);
                $this->database->setAttribute(
                    PDO::ATTR_DEFAULT_FETCH_MODE, 
                    PDO::FETCH_ASSOC
                );
            }
        }

        public function inscription($nom, $prenom, $adresse, $tel, $pwd, $profil){
            try {
            $result = $this->database->query("INSERT INTO `User` VALUE(null,'$nom','$prenom','$adresse','$tel','$pwd','$profil', '0')");
            //revoie 0 si erreur ou n si on pas d'erreur
            return $result->fetchAll();
            return 1;
            }catch(\PDOException $th) {
                return 0;
            }
        }

        public function connexion($tel, $pwd){
            $result = $this->database->query("SELECT * FROM `User` WHERE tel='$tel' AND pwd='$pwd'");
            return $result->fetch();
        }

        public function getAllProduct(){
            $result = $this->database->query("SELECT * FROM Produit WHERE corbeille='0'");
            return $result->fetchAll();
        }

        public function getnomProduct($search){
            $result = $this->database->query("SELECT * FROM Produit WHERE nom LIKE '%' .$search. '%'");
            return $result->fetchAll();
        }

        public function SuppProduct($id){
            $result = $this->database->query("UPDATE `Produit` SET corbeille='1' WHERE id ='$id'");
            return 1;
        }

        public function SuppUser($id){
            $result = $this->database->query("UPDATE `User` SET corbeille='1' WHERE id = '$id' ");
            return 1;
        }


        public function createProduct($nom, $description, $prixU,$img,$id_boutiquier){
            try {
                $result = $this->database->query("INSERT INTO `Produit` VALUE(NULL ,'$nom','$description','$prixU','$img','$id_boutiquier','0')");
                $result->fetch();
                return 1;
            } catch (\PDOException $th) {
                return 0;
            }
        }
        public function getProductByIdBoutiquier($id_boutiquier) {
            $result = $this->database->query("SELECT * FROM `produit` WHERE id_boutiquier='$id_boutiquier' AND corbeille='0' ");
            return $result->fetchAll();
        }
        public function getProductById($id_produit) {
            $result = $this->database->query("SELECT * FROM `produit` WHERE id='$id_produit'");
            return $result->fetch();
        }
        public function getAlluser(){
            $result = $this->database->query("SELECT * FROM user WHERE corbeille='0'");
            return $result->fetchAll();
        }

        public function getAlluserByid(){
            $result = $this->database->query("SELECT * FROM user WHERE id = '$id' AND corbeille='0'");
            return $result->fetchAll();
        }

    public function getClientPanier($id_client){
        $result = $this->database->query("SELECT * FROM `Panier` WHERE id_client='$id_client'");
        return $result->fetch();
    }
    public function createProduitPanier($id_panier,$id_produit,$nbr,$montantTOT){
        try {
            $result = $this->database->query("INSERT INTO `ProduitPanier` VALUE(null, '$id_panier', '$id_produit', '$nbr', '$montantTOT')");
            $result->fetch();
            return 1;
        } catch (\PDOException $th) {
            return 0;
        }
    }
    public function updatePanier($id_panier,$montantTOT){
        try {
            $result = $this->database->query("UPDATE `Panier` SET montantTOT='$montantTOT' WHERE id='$id_panier'");
            return 1;
            $result->fetch();
        } catch (\PDOException $th) {
            return 0 ;
        }
    }
    public function createPanier($montantTOT, $id_client){
        try {
            $result = $this->database->query("INSERT INTO `Panier` VALUE(null, '$montantTOT', '$id_client')");
            return 1;
        } catch (\PDOExcepetion $th) {
            return 0;
        }
    }
    public function getProduitPanier($id_panier){
        $result = $this->database->query("SELECT * FROM `Produit` JOIN `ProduitPanier` ON ProduitPanier.id_produit=Produit.id  WHERE id_panier='$id_panier'");
        return $result->fetchAll();
    }
    public function getProduitPanierbyid($id){
        $result = $this->database->query("SELECT * FROM `ProduitPanier` WHERE id='$id'");
        return $result->fetch();
    }
    public function updateNbrProduitPanier($id,$nbr,$montantTOT){
        try {
            $result = $this->database->query("UPDATE `ProduitPanier` SET nbr='$nbr',montantTOT='$montantTOT' WHERE id='$id'");
            return 1;
            $result->fetch();
        } catch (\PDOException $th) {
            return 0 ;
        }
    }

    public function createCommande($date, $montantTOT, $etat, $id_client){
        try {
            $result = $this->database->query("INSERT INTO `Commande` VALUE(null, '$date', '$montantTOT', '$etat', '$id_client')");
            $result->fetch();
            return 1;
        } catch (\PDOException $th) {
            return 0;
        }
    }

    public function getCommandeClient($id_client){
        try {
            $result = $this->database->query("SELECT * FROM `Commande` WHERE id_client='$id_client' ORDER BY id DESC");
        return $result->fetchAll();
        } catch (\PDOException $th) {
            return[];
        }
    }

    public function getProduitCommande($id_commande) {
        $result = $this->database->query("SELECT * FROM `ProduitCommande` JOIN `Produit` ON ProduitCommande.id_produit = Produit.id WHERE id_commande='$id_commande'");
        return $result->fetchAll();
    }

    public function createProduitCommande($id_commande, $id_produit, $nbr, $montantTOT){
        try {
            $result = $this->database->query("INSERT INTO `ProduitCommande` VALUE(null, '$id_commande', ' $id_produit', '$nbr', '$montantTOT')");
            $result->fetch();
            return 1;
        } catch (\PDOException $th) {
            die($th);
            return 0;
        }
    }

    public function deleteProduitCommande($id_commande, $id_produit, $nbr, $montantTOT){
        try {
            $result = $this->database->query("DELETE `ProduitCommande` SET Commande= '$commande' WHERE id='$id_produit'");
            $result->fetch();
            return 1;
        } catch (\PDOException $th) {
            return 0 ;
        }
    }

    public function deleteProduitPanier($id){
        try {
            $result = $this->database->query("DELETE FROM `ProduitPanier` WHERE id='$id'");
            $result->fetch();
            return 1;
        } catch (\PDOException $th) {
            return 0 ;
        }
    }
    public function resetPanier($id_panier){
        $result = $this->database->query("DELETE FROM `ProduitPanier` WHERE id_panier='$id_panier'");
        return $result->fetch();
    }
    
    public function getAllcommande(){
        $result = $this->database->query("SELECT * FROM commande");
        return $result->fetchAll();
    }
    
    public function rejetCommande($id){
        $result = $this->database->query("UPDATE `Commande` SET etat ='REJETER' WHERE id='$id'");
        return $result->fetch();
    }
    public function valideCommande($id){
        $result = $this->database->query("UPDATE `Commande` SET etat ='VALIDER' WHERE id='$id'");
        return $result->fetch();
    }
    public function deleteProduitbyid($id){
        $result = $this->database->query("SELECT * FROM `ProduitPanier` WHERE id='$id'");
        return $result->fetchAll();
    }

    public function updateProfil($id, $nom, $prenom, $adresse, $tel){
        try {
            $result = $this->database->query("UPDATE `User` SET nom='$nom', prenom='$prenom', adresse='$adresse', tel='$tel' WHERE id='$id'");
            return 1;
        } catch (\PDOException $th) {
            return 0 ;
        }
    }
    public function updateUser($id, $nom, $prenom, $adresse, $tel, $pwd){
            $result = $this->database->query("UPDATE `User` SET nom='$nom', prenom='$prenom', adresse='$adresse', tel='$tel', pwd='$pwd', corbeille='0' WHERE id='$id'");
            return 1;
    }
    public function getProfilByid($id){
        $result = $this->database->query("SELECT * FROM `User` WHERE id='$id'");
        return $result->fetch();
    }

    public function updateProduit($id_produit,$nom, $prixU, $description){
        $result = $this->database->query("UPDATE `Produit` SET nom='$nom', prixU='$prixU', description='$description' WHERE  id='$id_produit'");
        return 1;
}
    
}
?>