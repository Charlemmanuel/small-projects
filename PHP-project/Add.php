<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "charlem";

 session_start();

 if (!isset($_SESSION["authentifié"])) {
     header("Location: login.php");
     exit;
 }
 


 //Connection à la base de données
 $connection  = new mysqli($servername, $username,$password ,$database);

 $Nom_produit = $_POST["nom"] ?? "";
 $Description = $_POST["Description"] ?? "";
 $Prix = $_POST["Prix"] ?? "";


$errorMessage="";
$successMessage ="";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($Nom_produit) || empty($Description) || empty($Prix) ) {
        $errorMessage = "All the fields are required";
    } else {
        // Ajouter produit à la BDD     

        $sql = "INSERT INTO produits (Nom_produit, Description ,Prix)" . "VALUES ('$Nom_produit', '$Description', '$Prix')";
        $result = $connection->query($sql);

        if(!$result) {
            $errorMessage ="Invalid query: " .$connection->error;
            
        }else{     


        $Nom_produit = "";
        $Description = "";
        $Prix = "";
        

        $successMessage = "Produit ajouté avec succès!";
        header("Location: /charlystore/produit.php");
        exit;
    }
}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Ajouter le bouton de déconnexion -->
                    <li class="nav-item">
                        <a class="nav-link fw-bold btn btn-light" href="logout.php">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class ="container my-5">
        <h2>Ajouter un produit</h2>
        <?php
        if ( !empty($errorMessage)) {
            echo"
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        } ?>
         

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom produit :</label>
                <div class="col-sm-6">
                    <input type= "text" class="form-control" name="nom" value="<?php echo $Nom_produit; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description :</label>
                <div class="col-sm-6">
                    <input type= "text" class="form-control" name="Description" value="<?php echo $Description; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Prix (CAD) :</label>
                <div class="col-sm-6">
                    <input type= "text" class="form-control" name="Prix" value="<?php echo $Prix; ?>">
                </div>
            </div>

      
            <?php
        if ( !empty($successMessage)) {
            echo"
            <div class='row mb-3'>
            <div class='offset-sm-3 col-sm-6'>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>$successMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            </div>
            </div>
            ";
        } ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-dark">Ajouter</button>
                    </div>
                <div class="col-sm-3 d-grid">
                    <a class= "btn btn-outline-dark" href="/charlystore/produit.php" role="button">Annuler</a>
                </div>
            </div>
           
        </form>
    </div>
</body>
</html>