<?php
//($_SESSION['user'] = user toujour connecter
session_start();
if (!isset($_SESSION['user'])) {
  header("location:connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$panier = $transaction->getClientPanier($_SESSION['user']['id']);
if ($panier == null) {
  $result = $transaction->createPanier(0,$_SESSION['user']['id']);
  $panier = $transaction->getClientPanier($_SESSION['user']['id']);
}
$ProduitPanier = $transaction->getProduitPanier($panier['id']);
if (isset($_GET['action'])) {
  $result = $transaction->createCommande(date('Y/m/d'), $panier['montantTOT'], "EN COURS", $_SESSION['user']['id']);
  if ($result==1) {
    $commandes = $transaction->getCommandeClient($_SESSION['user']['id']);
    foreach ($ProduitPanier as $key =>$value) {
      $transaction->createProduitCommande($commandes[0]['id'],$value ['id_produit'], $value ['nbr'], $value ['montantTOT']);
    }
    $transaction->resetPanier($panier['id']);
    $transaction->updatePanier($panier['id'], 0);
    header('location:commandes.php');
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/styles/list.css">
    <link rel="stylesheet" href="../assets/styles/nave.css">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light custom-nav">
  <div class="nav">
    <a class="logo" href="#">Vente en ligne</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="men" aria-current="page" href="../index.php"><i class="bi bi-house-door"></i> Accueil</a>
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

<div class="container">
<table class="table table-striped table-hover tProduit">
        <thead class="entete">
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Prix Unitaire</th>
                <th>Quantité</th>
                <th>Montant Total</th>
            </tr>
        </thead>
        <tbody class="ligne">
        <?php foreach ($ProduitPanier as $key => $ppanier) { ?>
        <tr>
        <td><img class="icons" src="../assets/images/<?=$ppanier["image"]?>"></td>
            <td><?=$ppanier["nom"] ?></td>
            <td><?=$ppanier["prixU"] ?></td>
            <td><?=$ppanier["nbr"] ?></td>
            <td><?=number_format($ppanier['montantTOT'])?> cfa</td>
            <td>
              <a href="editproduitpanier.php?id=<?=$ppanier['id']?>"class="btn btn-outline-info"><i class="bi bi-cart-plus-fill add">Ajouter</i></a>
              <a href="deleteproduit.php?id=<?=$ppanier['id']?>"class="btn btn-outline-info"><i class="bi bi-cart-dash add">Supprimer</i></a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <div>
    <p class="Mtot">Montant Total <?=number_format($panier['montantTOT'])?> cfa</p>
    <a href="panier.php?action=valider" class="btn btn-outline-info bouton">Valider Panier</a>
    
    </div>
</div>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>