<?php
//($_SESSION['user'] = user toujour connecter
session_start();
if (!isset($_SESSION['user'])) {
  header("location:connexion.php");
}
if (($_SESSION['user']['profile']!= "ADMIN")) {
  header("location:connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBtransaction();
$alluser = $_SESSION['user']['id'];
$alluser = $transaction->getAlluser($alluser);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Boutiquiers</title>
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
          <a class="men" href="commandeclient.php"><i class="bi bi-basket3-fill"></i>Commandes Clients</a>
        </li>
        <li class="nav-item dropdown">
          <a class="men dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-people"></i>Boutiquiers
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="ajoutboutiquier.php">Ajouter</a></li>
            <li><a class="dropdown-item active" href="listboutiquier.php">Lister</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="men" href="deconnexion.php"><i class="bi bi-box-arrow-left"></i>Se deconnecter</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<table class="table table-striped table-hover tProduit">
        <thead class="entete">
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Adresse</th>
                <th>Tel</th>
                <th>Pwd</th>
                <th>Profile</th>
            </tr>
        </thead>
        <tbody class="ligne">
        <?php foreach ($alluser as $key => $user) { ?>
        <tr>
            <td><?=$user["nom"] ?></td>
            <td><?=$user["prenom"] ?></td>
            <td><?=$user["adresse"] ?></td>
            <td><?=$user["tel"] ?></td>
            <td><?=$user["pwd"] ?></td>
            <td><?=$user["profile"] ?></td>
            <td>
            <a class="btn btn-outline-success" href="edituser.php?id=<?=$user['id']?>">Ajouter</a>
            <a class="btn btn-outline-danger" href="deleteuser.php?id=<?=$user['id']?>">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>