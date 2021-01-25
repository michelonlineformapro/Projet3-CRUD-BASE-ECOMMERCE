<?php

//Ici $title de template.php dans la balise <title><?= $title ></title>
$title = "Ecommerce - VALIDER ENREGISTREMENT DU PRODUITS -";
//ob_start() démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée,
//hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.
ob_start();
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


//Recupation de input name = nom du produit
if(isset($_POST['nom_produit']) && !empty($_POST['nom_produit'])){
    $nom_produit = htmlspecialchars($_POST['nom_produit']);
    var_dump($nom_produit);
}else{
    echo "<p class='alert-danger'>Erreur, merci de remplir le champ nom du produit</p>";
}
//Recup de la description du produit
if(isset($_POST['description_produit']) && !empty($_POST['description_produit'])){
    $description_produit = htmlspecialchars($_POST['description_produit']);
    var_dump($description_produit);
}else{
    echo "<p class='alert-danger'>Erreur, merci de remplir le champ description du produit</p>";
}
//Recupération de l'url de la photo
if(isset($_POST['image_produit']) && !empty($_POST['image_produit'])){
    $image_produit = htmlspecialchars($_POST['image_produit']);
    var_dump($image_produit);
}else{
    echo "<p class='alert-danger'>Erreur, merci de remplir le champ image du produit</p>";
}


//Recuperation du prix
if(isset($_POST['prix_produit']) && !empty($_POST['prix_produit'])){
    $prix_produit = $_POST['prix_produit'];
    var_dump($prix_produit);
}else{
    echo "<p class='alert-danger'>Erreur, merci de remplir le champ prix du produit</p>";
}


$sql = "INSERT INTO produits (nom_produit, description_produit, image_produit, prix_produit) VALUES (?,?,?,?)";
$requete_insertion = $db->prepare($sql);
$requete_insertion->bindParam(1, $nom_produit);
$requete_insertion->bindParam(2, $description_produit);
$requete_insertion->bindParam(3, $image_produit);
$requete_insertion->bindParam(4, $prix_produit);

$requete_insertion->execute(array($nom_produit, $description_produit, $image_produit, $prix_produit));

if($requete_insertion){
    echo "<p class='alert-success'>Votre produit à bien été ajouté !</p>";
    echo "<a href='listeProduit.php' class='btn btn-outline-success'>Retour à la liste des produit</a>";
}else{
    echo "<p class='alert-danger'>Erreur: Merci de remplir tous les champs</p>";
}









$description_produit = $_POST['description_produit'];
$image_produit = $_POST['image_produit'];
$prix_produit = $_POST['prix_produit'];



var_dump($description_produit);
var_dump($image_produit);
var_dump($prix_produit);


//$content de template.php definis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation.
//Si la temporisation n'est pas activée, alors false sera retourné.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";
?>