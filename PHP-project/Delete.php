<?php
session_start();

if (!isset($_SESSION["authentifié"])) {
    header("Location: login.php");
    exit;
}

if (isset( $_GET["id"] )) {
    $id = $_GET["id"];

             $servername = "localhost";
             $username = "root";
            $password = "";
            $database = "charlem";

          //Connection à la base de données
           $connection  = new mysqli($servername, $username,$password ,$database);

           $sql = "DELETE FROM produits WHERE Id_produit=$id";

            $connection->query($sql);

}
header("Location: /charlystore/produit.php");
exit;

?>