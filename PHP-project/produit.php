

<?php
session_start();

if (isset($_SESSION['last_activity'])) {
    // Vérifie si l'utilisateur est inactif depuis plus de 10 minutes
    if (time() - $_SESSION['last_activity'] > 600) {
        // Détruit la session
        session_unset();
        session_destroy();        
        header("Location: produit.php");
        exit;
    }
}



// Met à jour le temps d'activité de l'utilisateur
$_SESSION['last_activity'] = time();

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
    <title>CharlyStore-Produit</title>
    <link rel="stylesheet" href="style2.css">
    <link rel= "stylesheet" href= "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    @font-face {
    font-family: "Jazz LET";
    src: url('chemin/vers/le/fichier/Jazz LET.ttf') format('truetype');
}

.charlystore-text {
    font-family: "Jazz LET", fantasy;
}
  
</style>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/charlystore/Accueil.php">
            <i class="fas fa-store-alt"></i>
            <span class="d-none d-lg-inline charlystore-text btn btn-outline-dark">CharlyStore</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link fw-bold btn btn-light " href="<?php echo $loginUrl; ?>"><?php echo $loginText; ?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class= "container my-5"  style="background-color: transparent;">
        <h2>Nos Produits</h2>
        <a class="btn btn-dark mt-3" href="/charlystore/Add.php" role="button">Ajouter un produit</a>
        <br>
        <table class="table mt-3" style="background-color: transparent;">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix (CAD)</th>
                    <th>Actions</th>
                </tr>               
            </thead>
            <tbody>
                <?php 
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "charlem";
                

                //Connection à la base de données
                $connection  = new mysqli($servername, $username,$password ,$database);

                if($connection->connect_error){
                    die("Connexion échouée : " . $connection -> connect_error);
                }

                $sql = "SELECT * FROM produits";
                $result = $connection->query($sql);

                if(!$result) {
                    die("Invalid query: " .$connection->error);
                }

                while($row =  $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>{$row['Nom_produit']}</td>
                    <td>{$row['Description']}</td>
                    <td>{$row['Prix']}</td>  
                    <td>
                    <a class='btn btn-dark' href='/charlystore/Edit.php?id={$row['Id_produit']}&edit=true' role='button'>Modifier</a>

                    <a class='btn btn-danger' href='/charlystore/Delete.php?id={$row['Id_produit']}' role='button'>Supprimer</a>
                       </td>                 
                </tr>              
               
                    ";
                }
                 ?>                          
            </tbody>
        </table>   
        
        <script>
// Affiche une alerte après 9 minutes et rafraîchit la page après 1 minute supplémentaire
setTimeout(function() {
    alert("Votre session va expirer. Veuillez cliquer sur OK pour continuer.");
    setTimeout(function() {
        window.location.reload(true); // Rafraîchit la page
    }, 6000); // 1 minute
}, 540000); // 9 minutes
</script>
</body>
</html>