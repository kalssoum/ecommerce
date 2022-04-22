<?php
session_start();
require('../DBTransaction.php');
$transaction = new DBTransaction();

if (isset($_POST['clique'])) {
  header('location:../index.php');
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $tel = $_POST['tel'];
  $adresse = $_POST['adresse'];
  $pwd = $_POST['pwd'];
  $profil = "CLIENT";
  $result = $transaction->inscription($nom, $prenom, $adresse, $tel, $pwd, $profil);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/styles/form.css">
    <link rel="stylesheet" href="assets/styles/nave.css">
</head>
<body>
<form action="inscription.php" method="POST" class="row g-3 boutiquierform" >
  <div class="col-md-6">
    <label for="nom" class="form-label">Nom</label>
    <input name="nom" type="text" class="form-control" id="nom">
  </div>
  <div class="col-md-6">
    <label for="prenom" class="form-label">Prenom</label>
    <input name="prenom" type="text" class="form-control" id="prenom">
  </div>
  <div class="col-md-6">
    <label for="telephone" class="form-label">Telephone</label>
    <input name="tel" type="number" class="form-control" id="telephne">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input name="pwd" type="password" class="form-control" id="inputPassword4">
  </div>
  <div class="col-12">
    <label for="inputAdresse" class="form-label">Adresse</label>
    <input name="adresse" type="text" class="form-control" id="inputAdresse" placeholder="1234 Main St">
  </div>
  
  </div>
  <div class="col-12">
    <button name="clique" type="submit" class="btn btn-primary">Ajouter</button>
  </div>
</form>
</body>
</html>