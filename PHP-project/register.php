<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "charlem";


session_start();

if(isset($_SESSION["authentifié"])){
    header("Location: Add.php");
    exit;
}

$nom ="";
$prénom=  "";
$date_naissance= "";
$email="";
$telephone= "";
$error= "";


if(isset($_POST['nom'])){
    $nom = $_POST['nom'];
    $prénom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $Password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];



    do{
        if(empty($nom)){
            $error = "Vous devez saisir le nom!";
            break;
        }

        if(empty($prénom)){
            $error = "Vous devez saisir le prénom!";
            break;
               
        }

        if(empty($date_naissance)){
            $error = "Vous devez saisir  la date de naissance!";
            break;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = "L'adresse email est invalide.";
            break;
        }

        //Connection à la base de données
        $connection  = new mysqli($servername, $username,$password ,$database);
//================VALIDER EMAIL===================================================================
        $statement = $connection->prepare("SELECT id FROM utilisateur WHERE email =?");

        $statement->bind_param('s', $email);

        $statement->execute();

        $statement->store_result();
        if ($statement->num_rows > 0) {
            $error = 'Cette adresse e-mail est déjà utilisée.';
            break;
        } 

        $statement->close();
//==========================================VALIDER NUMERO DE TELEPHONE===============================================
if(strlen($telephone) < 10){
    $error = "votre numero doit avoir au moins 10 chiffres";
    break;
}
//==========================================VALIDER MOT DE PASSE===============================================
if(strlen($Password) < 8){
    $error = "Mot de passe trop court";
    break;
}
       
//==========================================VALIDER  CONFIRMATION MOT DE PASSE===============================================
if($confirm_password != $Password){
    $error = "La confirmation du mot de passe ne correspond pas";
    break;
}

//==========================================Encrypter MOT DE PASSE===============================================
$encryptionKey = 'projects/projet-ua3/locations/global/keyRings/my-keyring/cryptoKeys/charly-key';
$decryptedPassword = openssl_decrypt($encryptedPasswordFromDatabase, 'aes-128-ctr', $encryptionKey, 0, '1234567890123456');

$Enc_Password = openssl_encrypt($Password, 'aes-128-ctr', $encryptionKey, 0, '1234567890123456');
$create_at = date('Y-m-d H:i:s');

$statement = $connection->prepare("INSERT INTO utilisateur (nom, prénom, date_naissance, email, phone, Password ) VALUES(?,?,?,?,?,?)");

$statement ->bind_param('ssssss', $nom, $prénom,$date_naissance, $email,$telephone, $Enc_Password);

$statement->execute();

$id = $statement->insert_id;

$statement->close();



$_SESSION["authentifié"] = true;
$_SESSION["id"] = $insert_id;
$_SESSION["nom"]=$nom;
$_SESSION["prenom"]= $prénom;
$_SESSION[ "date_naissance"]= $date_naissance;
$_SESSION["email"] = $email;
$_SESSION["telephone"]=$telephone;
$_SESSION["created_at"]=$create_at;

header( 'Location: Add.php' );
exit;
    }while(false);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>S'inscrire</title>
    <style>
        .rounded-container {
            max-width: 700px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

         
    @font-face {
    font-family: "Jazz LET";
    src: url('chemin/vers/le/fichier/Jazz LET.ttf') format('truetype');
}

.charlystore-text {
    font-family: "Jazz LET", fantasy;
}
     }
    </style>
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
<div class="rounded-container  container my-5">
    <h1 class="text-center">Créer un compte</h1>
    <form method="POST">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="nom">Nom :</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="nom" name="nom" required value="<?php echo $nom ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="prenom">Prénom :</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="prenom" name="prenom" required value="<?php echo $prénom ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="date_naissance">Date de naissance :</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" id="date_naissance" name="date_naissance" required value="<?php echo $date_naissance ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="email">Email :</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="telephone" >téléphone# :</label>
            <div class="col-sm-6">
                <input type="tel" class="form-control" id="telephone" name="telephone" required value="<?php echo $telephone ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="password">Mot de passe :</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="confirm_password">Confirmer le mot de passe :</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <?php
                if(!empty($error)){
                    echo "<p style='color:red'>".$error."</p>";
                }
                ?>

                <button type="submit" class="btn btn-dark">Créer compte</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-dark" href="/charlystore/produit.php" role="button">Annuler</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
