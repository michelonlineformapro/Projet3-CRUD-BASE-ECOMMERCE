<?php
ob_start();
$title = "Ecommerce - DÉTAILS DU PRODUITS -";

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

?>

<h1>DETAILS DU PRODUITS </h1>
<a href="listeProduit.php" class="btn btn-dark mt-5">Retour à la liste des produits</a>

<?php

//Requètes SQL
$sql = "SELECT * FROM produits WHERE id_produit = ?";
//Stock de la requète dans une vaiable ($requète) et appel de la connexion puis de la fonction requètée preparée
$requete = $db->prepare($sql);
//Objet qui retourne PDO statement etat de la table produits à l'instant
//var_dump($requete);

//Récupération de id <a href=detailsProduit.php?id_produit=<?= $row['id_produit']
//On stocke le resultat de $_GET['id_produit'] =  dans une variable
$id = $_GET['id_produit'];
//Passage du ? à la valeur de $_GET['id_produi']
$requete->bindParam(1, $id);
//Execute la requète
$requete->execute();
//pour afficher les vaeurs de la tables produits on doit utilisé la fonction fectch = rechercher
$resultat = $requete->fetch();

//var_dump($resultat);
//Retourne un valeur true (vrai) si des resultat s'affiche
if($resultat){
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom du produit</th>
                    <th>Description du produit</th>
                    <th>Image du produit</th>
                    <th>Prix du produit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $resultat['id_produit'] ?></td>
                    <td><?= $resultat['nom_produit'] ?></td>
                    <td><?= $resultat['description_produit'] ?></td>
                    <td><img src="<?= $resultat['image_produit'] ?>" alt="<?= $resultat['nom_produit'] ?>" title="<?= $resultat['nom_produit'] ?>">  </td>
                    <td><?= $resultat['prix_produit'] ?> €</td>
                </tr>
            </tbody>
        </table>
    <?php
}else{
    echo "<p class='alert-danger p-5'>Erreur : cet ID (produit) n'existe pas</p>";
}




echo "ICI c id du produit : " .$id;
var_dump($id);

var_dump($_GET['id_produit']);

$content = ob_get_clean();
require "template.php";