<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location:connexion.php");
}
if (($_SESSION['user']['profile']!="BOUTIQUIER")) {
  header("location:connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$suppcommande = $transaction->rejetCommande($_GET['idcommande']);
header("location:commandeclient.php");

?>