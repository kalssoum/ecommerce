<?php
//($_SESSION['user'] = user toujour connecter
require('../DBTransaction.php');
session_start();
$transaction = new DBTransaction();
$msg = "";
if (!isset($_SESSION['user'])) {
  header("location:connexion.php");
}
if (($_SESSION['user']['profile']!= "BOUTIQUIER")) {
  header("location:connexion.php");
}

function telechargeImage($imageInfos){
  $nomImage = $imageInfos['name'];
  $imagePath = $imageInfos['tmp_name'];
if (move_uploaded_file($imagePath, "../assets/images/".$nomImage)) {
  return $nomImage;
}
  return "";
}

if (isset($_POST) && isset($_POST['clique'])) {
  $nom = $_POST['nom'];
  $prixU = $_POST['prixU'];
  $description = $_POST['description'];
  $imageInfos = $_FILES['image'];
  $image = telechargeImage($_FILES['image']);
  $id_boutiquier = $_SESSION['user']['id'];
  $result = $transaction->createProduct($nom, $description, $prixU,$image,$id_boutiquier);
  if ($result==1) {
    header("location:listproduit.php");
  }
  $msg = "une erreur s'est produit";
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Produit</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/styles/form.css">
    <link rel="stylesheet" href="../assets/styles/nave.css">


</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light custom-nav">
  <div class="container-fluid">
    <a class="logo" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="men" aria-current="page" href="../index.php"> <i class="bi bi-house-door"></i> Accueil</a>
        </li>
        <li class="nav-item">
          <a class="men" href="panier.php"><i class="bi bi-cart4"></i>Panier</a>
        </li>
        <li class="nav-item">
          <a class="men" href="commandes.php"><i class="bi bi-bag-fill"></i>Commandes</a>
        </li>
        <li class="nav-item">
          <a class="men" href="profile.php"><i class="bi bi-person-circle"></i>Profile</a>
        </li>
        <li class="nav-item dropdown">
          <a class="men dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Produits
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item active" href="ajoutproduit.php">Ajouter</a></li>
            <li><a class="dropdown-item" href="listproduit.php">Lister</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="men" href="commandeclient.php"><i class="bi bi-basket3-fill"></i>Commandes Clients</a>
        </li>
        <li class="nav-item dropdown">
          <a class="men dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-people"></i>Utilisateurs
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="ajoutboutiquier.php">Ajouter</a></li>
            <li><a class="dropdown-item" href="listboutiquier.php">Lister</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="men" href="deconnexion.php"><i class="bi bi-box-arrow-left"></i>Se deconnecter</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<form action="ajoutproduit.php" method="POST" enctype="multipart/form-data" class="row g-3 boutiquierform" >
  <div class="col-md-6">
    <label for="nom" class="form-label">Nom</label>
    <input name="nom" type="text" class="form-control" id="nom">
  </div>
  <div class="col-md-6">
    <label for="prixU" class="form-label">Prix Unutaire</label>
    <input name="prixU" type="number" class="form-control" id="prixU">
  </div>
  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Description</label>
  <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
<div class="mb-3">
  <label for="formFile" class="form-label">Image du produit</label>
  <input name="image" class="form-control" type="file" id="formFile">
</div>
  <div class="col-12">
    <button name="clique" type="submit" class="btn btn-primary">Ajouter</button>
  </div>
</form>

<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>