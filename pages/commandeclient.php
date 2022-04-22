<?php
//($_SESSION['user'] = user toujour connecter
session_start();
if (!isset($_SESSION['user'])) {
  header("location:connexion.php");
}
if (($_SESSION['user']['profile']!= "BOUTIQUIER")) {
  header("location:connexion.php");
}
require('../DBTransaction.php');
  $transaction = new DBTransaction();
  $CommandeClient = $transaction->getAllcommande();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes Client</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
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
          <i class="bi bi-archive"></i>Produits
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="ajoutproduit.php">Ajouter</a></li>
            <li><a class="dropdown-item" href="listproduit.php">Lister</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="men active" href="commandeclient.php"><i class="bi bi-basket3-fill"></i>Commandes Clients</a>
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

<div>
<table class="table table-striped table-hover tProduit">
        <thead>
            <tr>
                <th>Date</th>
                <th>etat</th>
                <th>montantTOT</th>
                <th>Id Client</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="ligne">
        <?php foreach ($CommandeClient as $key=>$commandes) { ?>
        <tr>
            <td><?=$commandes["date"] ?></td>
            <td><?=$commandes["etat"] ?></td>
            <td><?=$commandes["montantTOT"] ?></td>
            <td><?=$commandes["id_client"] ?></td>
            <td><a  href="detailCommande.php?idcommande=<?=$commandes['id']?>"><i class="bi bi-eye-fill"></i></a></td>
            <td><a  href="valideCommande.php?idcommande=<?=$commandes['id']?>"><button type="button" class="btn btn-outline-success">VALIDER</button></a></td>
            <td><a  href="deleteCommande.php?idcommande=<?=$commandes['id']?>"><button type="button" class="btn btn-outline-danger"> REJETER</button></a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>