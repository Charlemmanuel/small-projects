<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION["authentifié"]) && $_SESSION["authentifié"] === true) {
    $loginText = "Déconnexion";
    $loginUrl = "logout.php"; // URL de déconnexion
} else {
    $loginText = "Se connecter";
    $loginUrl = "login.php"; // URL de connexion
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>CharlyStore-Accueil</title>
    <link rel="stylesheet" href="style.css">        
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
    <a class="navbar-brand" href="/charlystore/Accueil.php">
            <i class="fas fa-store-alt"></i>
             <span class="d-none d-lg-inline charlystore-text btn btn-outline-dark">CharlyStore</span>            
        </a>       
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                   <a href="http://localhost/charlystore/produit.php"class=" nav-link fw-bold  btn btn-light ">Voir nos produits</a>
               </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link fw-bold  btn btn-light" href="<?php echo $loginUrl; ?>"><?php echo $loginText; ?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class= "container my-5">
        <h3>Bienvenue sur le magasin en ligne CharlyStore,
            vous pouvez stocker ici tous les produits que vous 
            voudriez revendre.</h3>
             </div>

        <div class="image-container">
            <img src="https://www.notebookcheck.net/fileadmin/_processed_/b/1/csm_teaser_87a40a99d2.jpg" alt="acceuil" />
            <p>Laptop de tous les jours pour monsieur tout le monde
Parfait pour:

Les étudiants
Les professionnels
Les familles
Les utilisateurs occasionnels
Caractéristiques:

Léger et portable
Écran haute résolution.</p>
        </div>

        <div class="image-container reverse">
            <img src="https://www.zdnet.com/a/img/resize/e9794c8e2b8a9a9173f0b1f496406d551f6e80b5/2023/08/22/8c939452-01fe-4087-a469-c902c577f0a1/asus-zenfone-10-in-hand.jpg?auto=webp&fit=crop&height=900&width=1200" alt="acceuil" />
            <p>Smartphone milieu de gamme:

Parfait pour:

Les utilisateurs qui recherchent un bon rapport qualité-prix
Les personnes qui veulent un smartphone performant pour les tâches quotidiennes
Les photographes amateurs.
Caractéristiques:

Écran Full HD
Processeur performant
Caméra arrière double
Grande autonomie de la batterie
Stockage extensible
Design élégant et moderne


</p>
        </div>

        <div class="image-container">
            <img src="https://www.denofgeek.com/wp-content/uploads/2020/07/MSI-laptops.jpg?fit=1200%2C675" alt="acceuil" />
            <p>Laptop gaming pour gamers et développeurs:

Parfait pour:

Les gamers qui recherchent un ordinateur portable puissant
Les développeurs qui ont besoin d'une machine performante
Les utilisateurs qui veulent un ordinateur portable polyvalent
Caractéristiques:

Processeur puissant
Carte graphique NVIDIA
Écran haute résolution
Clavier rétroéclairé
Grand espace de stockage
Système de refroidissement performant
Avantages:

Offre des performances de jeu exceptionnelles
Permet de travailler sur des projets complexes
Offre une expérience visuelle immersive
Reste performant même en utilisation intensive
Est facile à transporter.</p>
        </div>

         <div class="image-container reverse ">
            <img src="https://images.macrumors.com/article-new/2023/09/iPhone-15-General-Feature-Black.jpg" alt="acceuil" />
            <p>Smartphone haut de gamme premium:

Parfait pour:

Les utilisateurs qui recherchent le meilleur smartphone du marché
Les personnes qui veulent un smartphone performant et élégant
Les utilisateurs qui veulent un smartphone avec un appareil photo de qualité
Caractéristiques:

Écran AMOLED
Processeur ultra-performant
Caméra arrière triple
Grande autonomie de la batterie
Stockage extensible
Design premium et matériaux de haute qualité
Avantages:

Offre une expérience utilisateur exceptionnelle
Prend des photos et des vidéos de qualité professionnelle
Reste performant toute la journée
Est facile à utiliser et à configurer
Disponible dans une variété de couleurs et de styles.</p>
        </div>

        <div class="image-container special">
            <img src="https://i.ebayimg.com/images/g/umAAAOSwmbZk~PDh/s-l1200.jpg" alt="acceuil" />
            <p>Accessoires pour smartphones et laptops:

Nous vendons une large gamme d'accessoires pour smartphones et laptops, tels que:

Écouteurs sans fil
Chargeurs sans fil
Coques de protection
Étuis
Claviers
Souris
Adaptateurs
Et bien plus encore!
Nos accessoires sont de haute qualité et sont disponibles à des prix abordables..</p>
        </div>
   
    </div>
    </div>

</body>
</html>