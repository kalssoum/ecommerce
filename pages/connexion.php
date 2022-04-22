<?php
session_start();
require('../DBTransaction.php');
$transaction = new DBTransaction();
$msg="";
if (isset($_POST) && isset($_POST['clique'])) {
  $tel = $_POST['tel'];
  $pwd = $_POST['pwd'];
  $result = $transaction->connexion($tel, $pwd);
  if($result!=null) {
     $_SESSION['user'] = $result;
     header("location:../index.php");
  }
  $msg = "Numero de téléphone ou mot de passe invalide";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/styles/form.css">
    <link rel="stylesheet" href="../assets/styles/nave.css">
</head>
<body>
<div class=""> 
<form action="connexion.php" method="POST" class="row g-3 boutiquierform" >
  <h1 class="titre">Connexion</h1>
  <?php if($msg!=""){ ?>
    <div class="alert alert-danger" role="alert">
     <?=$msg?>
</div>
  <?php } ?>
  <div class="col-md-12">
    <label for="telephone" class="form-label">Telephone</label>
    <input  name="tel" type="number" class="form-control" id="telephne" >
  </div>
  <div class="col-md-12">
    <label for="inputPassword4" class="form-label">Password</label>
    <input name="pwd" type="password" class="form-control" id="inputPassword4">
  </div>
  <div class="col-md-3">
    <a class="btn btn-outline-primary" href="https://www.facebook.com"><i class="bi bi-facebook"></i></a>
    <a class="btn btn-outline-primary" href="https://www.instagram.com"><i class="bi bi-instagram"></i></a>
    <a class="btn btn-outline-primary" href="https://www.twitter.com"><i class="bi bi-twitter"></i></a>
  </div>
  <div class="col-12 button">
    <button name="clique" type="submit" class="btn btn-primary">Ajouter</button>
  </div>
</form>
</div>
</body>
</html> 