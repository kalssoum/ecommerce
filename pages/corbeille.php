<?php
session_start();
if (!isset($_SESSION['user'])) {
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$delete = $transaction->SuppProduct($_GET['id']);
header('location:listproduit.php');
?>