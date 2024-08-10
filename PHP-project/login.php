<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "charlem";

session_start();


$email="";
$error= "";


if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $Password = $_POST['password'];  

        //Connection à la base de données
        $connection  = new mysqli($servername, $username,$password ,$database);
//================VALIDER EMAIL===================================================================
$statement = $connection->prepare("SELECT id, nom, prénom, date_naissance, phone, Password FROM utilisateur WHERE email = ?");
$statement->bind_param('s', $email);
$statement->execute();
$result = $statement->get_result();


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $encryptedPasswordFromDatabase = $row['Password'];

    // Chiffrer le mot de passe fourni par l'utilisateur
    $encryptionKey = 'projects/projet-ua3/locations/global/keyRings/my-keyring/cryptoKeys/charly-key';
    $decryptedPasswordFromDatabase = openssl_decrypt($encryptedPasswordFromDatabase, 'aes-128-ctr', $encryptionKey, 0, '1234567890123456');


$statement->bind_result($id, $nom, $prenom, $date_naissance, $phone,  $Password);


if ($decryptedPasswordFromDatabase === $Password) {
    // Mot de passe correct, connectez l'utilisateur
    $_SESSION["authentifié"] = true;
    $_SESSION["id"] = $row['id'];

  // Redirection vers Add.php ou Edit.php en fonction de l'URL
  if (isset($_SESSION["authentifié"]) && $_SESSION["authentifié"] === true) {
    if (isset($_GET['edit'])) {
        header("Location: Add.php");
    } else {
        header("Location: Edit.php");
    }
    exit;
}


} else {
// Mot de passe incorrect
$error = "Mot de passe incorrect";
}
} else {
// L'e-mail n'existe pas dans la base de données
$error = "L'email n'existe pas";
}

$statement->close();
$connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>    
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/charlystore/Accueil.php">
            <i class="fas fa-store-alt"></i>
            <span class="d-none d-lg-inline charlystore-text btn btn-outline-dark">CharlyStore</span>            
        </a>       
    </div>
</nav>

<div class="rounded-container container my-5">
    <h1 class="text-center">Veuillez vous connecter</h1>

    <form method="POST">     
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="email">Email :</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" id="email" name="email" required autocomplete="email" value="<?php echo $email; ?>">
            </div>
        </div>
    
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="password">Mot de passe :</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
            </div>
        </div>
                
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <?php if(!empty($error)): ?>
                    <p class="error-message"><?php echo $error; ?></p>
                <?php endif; ?>
                <button type="submit" class="btn btn-dark">Se connecter</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-dark" href="/charlystore/produit.php" role="button">Annuler</a>
            </div>
        </div>        
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-6">
                Vous n'avez pas de compte?
                <a href="register.php"> Créer un compte</a>
            </div>
        </div>
    </form>
</div>

</body>
</html>
