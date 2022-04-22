<?php
    require('./DBTransaction.php');
    $transaction = new DBTransaction();
    $allProduct = $transaction->getAllProduct();
    $alluser = $transaction->getAlluser();

    if (isset($_GET) && isset($_GET['clique'])) {
      $search = $_GET['search'];
      $allProduct = $transaction->getnomProduct($search);
    }else{
      $allProduct = $transaction->getAllProduct();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/styles/list.css">
    <link rel="stylesheet" href="assets/styles/nave.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light custom-nav">
  <div class="container-fluid menu">
    <a class="logo" href="#">SBB-Fashion</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="men active" aria-current="page" href="#"> <i class="bi bi-house-door"></i> Accueil</a>
        </li>
        <li class="nav-item">
          <a class="men" href="pages/panier.php"><i class="bi bi-cart4"></i>Panier</a>
        </li>
        <li class="nav-item">
          <a class="men" href="pages/commandes.php"><i class="bi bi-bag-fill"></i>Commandes</a>
        </li>
        <li class="nav-item">
          <a class="men" href="pages/profile.php"><i class="bi bi-person-circle"></i>Profile</a>
        </li>
        <li class="nav-item dropdown">
          <a class="men dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-archive"></i>Produits
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="pages/ajoutproduit.php">Ajouter</a></li>
            <li><a class="dropdown-item" href="pages/listproduit.php">Lister</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="men" href="pages/commandeclient.php"><i class="bi bi-basket3-fill"></i>Commandes Clients</a>
        </li>
        <li class="nav-item dropdown">
          <a class="men dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-people"></i>Utilisateurs
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="pages/ajoutboutiquier.php">Ajouter</a></li>
            <li><a class="dropdown-item" href="pages/listboutiquier.php">Lister</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="men" href="pages/connexion.php"><i class="bi bi-box-arrow-in-right"></i>Connexion</a>
        </li>
        <li class="nav-item">
          <a class="men" href="pages/inscription.php"><i class="bi bi-card-text"></i>Inscription</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div id="carouselExampleControls" class="carousel slide " data-bs-ride="carousel">
  <div class="carousel-inner ">
    <div class="carousel-item active">
      <img src="./assets/images/perfume.jpg" class="d-block w-100 myslide" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./assets/images/bleue.jpg" class="d-block w-100 myslide" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./assets/images/shoes.jpg" class="d-block w-100 myslide" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./assets/images/image1.jpg" class="d-block w-100 myslide" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./assets/images/lip.jpg" class="d-block w-100 myslide" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./assets/images/image6.jpg" class="d-block w-100 myslide" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./assets/images/image7.jpg" class="d-block w-100 myslide" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="container listproduits">
<?php foreach ($allProduct as $key => $produit) { ?>
<div class="card" style="width: 18rem;">
  <img src="./assets/images/<?=$produit['image']?>"class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?=$produit['nom']?></h5>
    <p class="card-text"><?=$produit['description']?></p>
    <p class="prix">Prix Unitaire : <?=number_format($produit['prixU'])?> cfa</p>
    <a class="btn btn-outline-success" href="pages/ajoutpanier.php?idProduit=<?=$produit['id']?>"><i class="bi bi-cart-plus"></i>Ajouter</a>
    
  </div>



</div>
<?php  } ?>
</div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>