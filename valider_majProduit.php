<?php

ob_start();
$title = "Ecommerce - CONFIRMATION DE LA MISE A JOUR DU PRODUITS -";

//COONEXION A LE BASE de DONNÉES
//Stock des valeur nom utilistateur phpmyadmin et mot de passe
$user = "root";
$pass = "";
//Essaie de te connecter
try {
    //Stockage et instance de la classe PDO pour connecter php et mysql
    $db = new PDO("mysql:host=localhost;dbname=ecommerce;charset=utf8", $user, $pass);
    //Fonction static de la classe PDO pour debug la connexion en cas d'erreur
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class='alert-success p-5'>Salut c bon t connecté a PDO MySQL</p>";
} catch (PDOException $exception) {
    die("Erreur de connexion a PDO MySQL :" . $exception->getMessage());
}

//Recuperation des valeurs du formulaire avec $_POST[''] qui fait référence a l'attribut name="" dans des formulaires
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




//Requète de misa jour d'un produit (ATTENTION a bien ajouter toutes les propriétées de la table produit
$sql = "UPDATE produits SET nom_produit = ?, description_produit = ?, image_produit = ?, prix_produit = ? WHERE id_produit = ?";
//Stockage de la requète préparée dans une variable
$update = $db->prepare($sql);

//On lie les 4 ? a des nouvelles valeurs
$update->bindParam(1, $nom_produit);
$update->bindParam(2, $description_produit);
$update->bindParam(3, $image_produit);
$update->bindParam(4, $prix_produit);
//Re recuperation de id ud produit graca ala super globale =_GET['id_maj'];
$valide_maj_id = $_GET['id_maj'];
echo "recupération de id produite depuis un formulaire de lisea jour : " .$valide_maj_id;

$resultatUpdate = $update->execute(array($nom_produit, $description_produit, $image_produit, $prix_produit,$valide_maj_id));
//si $resultatUpdate === true
if($resultatUpdate){
    //Requètes SQL
    $sql = "SELECT * FROM produits WHERE id_produit = ?";
//Stock de la requète dans une vaiable ($requète) et appel de la connexion puis de la fonction requètée preparée
    $requete = $db->prepare($sql);
//Objet qui retourne PDO statement etat de la table produits à l'instant
//var_dump($requete);

    $mise_a_jour_id = $_GET['id_maj'];
    echo "ID du produit à mettre a jour = " .$mise_a_jour_id;
//Passage du ? à la valeur de $_GET['id_produi']
    $requete->bindParam(1, $mise_a_jour_id);
//Execute la requète
    $requete->execute();
//pour afficher les vaeurs de la tables produits on doit utilisé la fonction fectch = rechercher
    $resultat = $requete->fetch();

    ?>
    <div class="alert-success p-5">
        <h1 class="text-center text-warning">Votre produit à bien été modifié !</h1>
    <ul class="list-group">
        <li class="list-group-item">ID du produit : <?= $resultat['id_produit'] ?></li>
        <li class="list-group-item">Nom du produit<?= $resultat['nom_produit'] ?></li>
        <li class="list-group-item">Description du produit<?= $resultat['description_produit'] ?></li>
        <li class="list-group-item">Image du produit<img src="<?= $resultat['image_produit'] ?>" alt="<?= $resultat['nom_produit'] ?>" title="<?= $resultat['nom_produit'] ?>">  </li>
        <li class="list-group-item">Prix du produit<?= $resultat['prix_produit'] ?> €</li>
    </ul>
        <a href="listeProduit.php" class="btn btn-danger">Retour à la liste des produits</a>
    </div>
    <?php
}else{
    echo "<p class='alert-danger p-5'>Une erreur est survenue lors de la mise à jour du produit</p>";
}


//$content de template.php definis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation.
//Si la temporisation n'est pas activée, alors false sera retourné.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";


