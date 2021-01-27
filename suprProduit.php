<?php
ob_start();

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

?>


<div class="alert-danger p-5">
    <h1 class="text-center text-danger"><strong>ATTENTION</strong></h1>
    <h2 class="text-center text-dark">LE PRODUIT CONCERNER VA ETRE SUPPRIMÉ</h2>
    <?php
    //Requètes SQL
    $sql = "SELECT * FROM produits WHERE id_produit = ?";
    //Stock de la requète dans une vaiable ($requète) et appel de la connexion puis de la fonction requètée preparée
    $requete = $db->prepare($sql);
    //Objet qui retourne PDO statement etat de la table produits à l'instant
    //var_dump($requete);

    //Récupération de id <a href=detailsProduit.php?id=<?= $row['id_produit']
    //On stocke le resultat de $_GET['id_produit'] =  dans une variable
    //Recupration de id dans url grace a la variable super globale $_GET
    $id = $_GET['id'];

    echo "LA CLE PASSER DANS URL + SA VALEUR = " .$id;
    var_dump($id);

    //Passage du ? à la valeur de $_GET['id_produi']
    $requete->bindParam(1, $id);
    //Execute la requète
    $requete->execute();
    //pour afficher les vaeurs de la tables produits on doit utilisé la fonction fectch = rechercher
    $resultat = $requete->fetch();
    ?>
    <ul class="list-group">
        <li class="list-group-item">ID : <?= $resultat['id_produit'] ?></li>
        <li class="list-group-item">NOM : <?= $resultat['nom_produit'] ?></li>
        <li class="list-group-item">DESCRIPTION : <?= $resultat['description_produit'] ?></li>
        <li class="list-group-item">PHOTO : <img src="<?= $resultat['image_produit'] ?>" alt="<?= $resultat['nom_produit'] ?>" title="<?= $resultat['nom_produit'] ?>">  </li>
        <li class="list-group-item">PRIX : <?= $resultat['prix_produit'] ?> €</li>
    </ul>

    <a href="confirmerSupressionProduit.php?id=<?=$resultat['id_produit'] ?>" class="btn btn-danger mt-5">CONFIRMER LA SUPRESSION DU PRODUIT = <?= $resultat['nom_produit'] ?></a>


</div>

    <a href="listeProduit.php" class="btn btn-dark mt-5">ANNULER</a>


<?php

$content = ob_get_clean();
require "template.php";