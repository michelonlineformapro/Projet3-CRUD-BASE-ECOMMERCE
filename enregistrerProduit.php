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
//Si la variable existe et si elle n'est pas vide alors
if(isset($_POST['nom_produit']) && !empty($_POST['nom_produit'])){
    $nom_produit = htmlspecialchars(strip_tags($_POST['nom_produit']));
    //on stock $_POST[''] dans une variable et on supprime les balise html avec htmlspecialchar et striptags
    //Le premier supprime complétement les balises html et php et javascript, l'autre convertit les caractères spéciaux en entité HTML
    // ("<" devient "&lt;" par exemple) mais ton lien le montre bien.
}else{
    //Sinon on affiche une erreur
    echo "<p class='alert-danger'>Erreur, merci de remplir le champ nom du produit</p>";
}
//Recup de la description du produit
if(isset($_POST['description_produit']) && !empty($_POST['description_produit'])){
    $description_produit = htmlspecialchars(strip_tags($_POST['description_produit']));
    var_dump($description_produit);
}else{
    echo "<p class='alert-danger'>Erreur, merci de remplir le champ description du produit</p>";
}
//Recupération de l'url de la photo
if(isset($_POST['image_produit']) && !empty($_POST['image_produit'])){
    $image_produit = htmlspecialchars(strip_tags($_POST['image_produit']));
    var_dump($image_produit);
}else{
    echo "<p class='alert-danger'>Erreur, merci de remplir le champ image du produit</p>";
}

//Recuperation du prix
if(isset($_POST['prix_produit']) && !empty($_POST['prix_produit'])){
    $prix_produit = htmlspecialchars(strip_tags($_POST['prix_produit']));
    var_dump($prix_produit);
}else{
    echo "<p class='alert-danger'>Erreur, merci de remplir le champ prix du produit</p>";
}

//On ecrit la reqète SQL soit inserer dans la table produits les(element) auquel on assigne une valeurs
$sql = "INSERT INTO produits (nom_produit, description_produit, image_produit, prix_produit) VALUES (?,?,?,?)";
//Creation d'une requète péparée avec la fonction prepare de PDO qui execute la requète SQL
$requete_insertion = $db->prepare($sql);
//On lie les elements les 4 ???? a la variable récupérée dans le formulaire
$requete_insertion->bindParam(1, $nom_produit);
$requete_insertion->bindParam(2, $description_produit);
$requete_insertion->bindParam(3, $image_produit);
$requete_insertion->bindParam(4, $prix_produit);


//Si l'insertion fonctionne
if($requete_insertion->execute(array($nom_produit, $description_produit, $image_produit, $prix_produit))){
    //Message de réusite + bouton de retour à la liste
    echo "<p class='alert-success'>Votre produit à bien été ajouté !</p>";
    echo "<a href='listeProduit.php' class='btn btn-outline-success'>Retour à la liste des produit</a>";
}else{
    echo "<p class='alert-danger'>Erreur: Merci de remplir tous les champs</p>";
}


/*
$description_produit = $_POST['description_produit'];
$image_produit = $_POST['image_produit'];
$prix_produit = $_POST['prix_produit'];



var_dump($description_produit);
var_dump($image_produit);
var_dump($prix_produit);
*/

//$content de template.php definis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation.
//Si la temporisation n'est pas activée, alors false sera retourné.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";
?>