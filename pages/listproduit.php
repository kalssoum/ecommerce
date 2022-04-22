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
$transaction = new DBtransaction();
$id_boutiquier = $_SESSION['user']['id'];
$produits = $transaction->getProductByIdBoutiquier($id_boutiquier);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Produits</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/styles/list.css">
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
          <a class="men active" href="panier.php"><i class="bi bi-cart4"></i>Panier</a>
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
            <li><a class="dropdown-item active" href="listproduit.php">Lister</a></li>
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

<div class="container listproduits">
<?php foreach ($produits as $key => $produit) { ?>
<div class="card" style="width: 18rem;">
  <img src="../assets/images/<?=$produit['image']?>"class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?=$produit['nom']?></h5>
    <p class="card-text"><?=$produit['description']?></p>
    <div class="col-md-12">
    <a class="btn btn-outline-success" href="editproduit.php?idProduit=<?=$produit['id']?>">Ajouter</a>
    <a class="btn btn-outline-danger" href="corbeille.php?id=<?=$produit['id']?>">Supprimer</a>
  </div>
  </div>



</div>

<?php  } ?>

</div>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>