<?php
session_start();
if (!isset($_SESSION['user'])) {
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$delete = $transaction->SuppUser($_GET['id']);
header("location:listboutiquier.php");

?>