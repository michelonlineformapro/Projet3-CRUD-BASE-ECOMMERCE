<?php
//Appel du template

//TEST SANS ob_start()

//Connexion à la base de donnée ecommerce PDO
//Rappel de la connexion PDO
//COONEXION A LE BASE de DONNÉES
//Stock des valeur nom utilistateur phpmyadmin et mot de passe
$user = "root";
$pass = "";
//Essaie de te connecter
try{
    //Stockage et instance de la classe PDO pour connecter php et mysql
    $db = new PDO("mysql:host=localhost;dbname=ecommerce;charset=utf8", $user, $pass);
    //Fonction static de la classe PDO pour debug la connexion en cas d'erreur
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class='alert-success p-5'>Salut c bon t connecté a PDO MySQL</p>";
}catch(PDOException $exception){
    die("Erreur de connexion a PDO MySQL :" .$exception->getMessage());
}


//SUPPRIMER UNE LIGNE DE LA TABLE produits

$sql = "DELETE FROM produits WHERE id_produit = ?";
//Recup l'id passer dans l'url grace a la super globale $_GET <a herf=fichier.php?cle=valeur(dans la table produit (soit id_produit)>
$id = $_GET['id'];
echo "LA CLE PASSER DANS URL + SA VALEUR = " .$id;
var_dump($id);
//Creation d'une requète prépare pour lier l'element ? = $id
$supression = $db->prepare($sql);
//Bind de $id à ?
$supression->bindParam(1, $id);
//Execution de la reqète
$supression->execute();

//Verification conditionnelle
if($supression){
    echo "<p class='alert-success p-5'>Le produit à bien été supprimé !</p>";
    echo "<a class='btn btn-success' href='listeProduit.php'>Retour a la liste des produits</a>";
}else{
    echo "<p class='alert-danger p-5'>Erreur lors de la supression du produit</p>";
}



$content = ob_get_clean();
require "template.php";