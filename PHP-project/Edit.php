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


$Id_produit="";
$Nom_produit = "";
$Description = "";
$Prix = "";


$errorMessage="";
$successMessage ="";


if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (!isset($_GET["id"])) {
        header("Location: /charlystore/produit.php");
        exit;
    } 
    $Id_produit=$_GET["id"];

    $sql = "SELECT * FROM produits WHERE Id_produit= $Id_produit";
                $result = $connection->query($sql);
                $row = $result -> fetch_assoc();

    if(!$row){
        header("Location: /charlystore/produit.php");
        exit;
    }    
    
    $Nom_produit = $row["Nom_produit"] ?? "";
    $Description = $row["Description"] ?? "";
    $Prix = $row["Prix"] ?? "";

}
    
    else {

 $Id_produit=$_POST["id"] ?? "";
 $Nom_produit = $_POST["Nom_produit"] ?? "";
 $Description = $_POST["Description"] ?? "";
 $Prix = $_POST["Prix"] ?? "";

 do{
    if(empty($Nom_produit) || empty($Description) || empty($Prix)){
         $errorMessage .= "All the fields are required";
    }

    $sql = "UPDATE produits SET Nom_produit = '$Nom_produit', Description = '$Description', Prix = '$Prix' WHERE Id_produit = '$Id_produit'";



    $result = $connection->query($sql);


    if(!$result) {
        $errorMessage ="Invalid query: " .$connection->error;
        break;
    }

    $successMessage = "Produit modifié avec succès!";
    header("Location: /charlystore/produit.php");
    exit;


 }while(true);
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit</title>
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
                    <li class="nav-item">
                        <a class="nav-link fw-bold btn btn-light" href="logout.php">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class ="container my-5">
        <h2>Modifier produit</h2>
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
            <input type="hidden"  name="id" value="<?php echo $Id_produit; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom produit :</label>
                <div class="col-sm-6">
                    <input type= "text" class="form-control" name="Nom_produit" value="<?php echo $Nom_produit; ?>">
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
                    <button type="submit" class="btn btn-dark">Modifier</button>
                    </div>
                <div class="col-sm-3 d-grid">
                    <a class= "btn btn-outline-dark" href="/charlystore/produit.php" role="button">Annuler</a>
                </div>
            </div>
           
        </form>
    </div>
</body>
</html>