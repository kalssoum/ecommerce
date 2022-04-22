<?php
// get c'est pour les SELECT create c'est pour les INSERT
session_start();
if (!isset($_SESSION['user'])) {
  header("location:connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$idProduit = $_GET['idProduit'];
$produit = $transaction->getProductById($idProduit);

if ($produit == null) {
    die("Ce produit n'est pas disponible");

}
$prixU = $produit['prixU'];
$id_client =  $_SESSION['user']['id'];
$panier = $transaction->getClientPanier($id_client);
//creation de panier
if ($panier == null) {
  $result = $transaction->createPanier(0, $id_client);
  $panier = $transaction->getClientPanier($id_client);
}
//ajout produit dans son panier
$id_panier = $panier['id'];
    $result = $transaction->createProduitPanier($id_panier, $idProduit, 1, $prixU);
    if ($result == 1) {
      $montantTOT = $panier['montantTOT'] + $prixU;
      $result = $transaction->updatePanier($panier['id'], $montantTOT);
      header('location:panier.php');
    }






















?>