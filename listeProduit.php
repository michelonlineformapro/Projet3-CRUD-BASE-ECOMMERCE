<?php
//Ici $title de template.php dans la balise <title><?= $title ></title>
$title = "Ecommerce - NOS PRODUITS -";
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


?>
<div class="text-center">

<h1 class="text-warning text-info">BAZAR.COM</h1>
<h2 class="text-warning text-info">Votre espace d'administration</h2>
<a href="ajouterProduit.php" class="btn btn-outline-danger">AJOUTER UN PRODUIT</a>
<?php
//La requète sql stockée dans dans une variable
$sql = "SELECT * FROM produits ORDER BY id_produit DESC";
//creation d'une variable qui stocke la connexion a PDO et l'execution de la requète SQL
$resultat = $db->query($sql);

?>
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Image</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Détails</th>
            <th>Mettre à jour</th>
            <th>Supprimer</th>
        </tr>
    </thead>

     <!--Appel des $row + nom de l'objet de la table produits-->
    <tbody>
    <?php
    //Boucle de lecture (connexion = $db + fonction query() PDO + requète SQL = $row)
foreach($db->query("SELECT * FROM produits ORDER BY id_produit DESC") as $row){
    //Creation d'une liste pour chaque elements
    ?>
        <tr>
            <td><?php echo $row['nom_produit'] ?></td>
            <td><img src="<?= $row['image_produit'] ?>" alt="<?= $row['nom_produit'] ?>" title="<?= $row['nom_produit'] ?>"/></td>
            <td><?php echo $row['description_produit'] ?></td>
            <td><?php echo $row['prix_produit'] ?> €</td>
            <td><a href="detailsProduit.php?id_produit=<?= $row['id_produit']  ?>" class="btn btn-warning">Détails du produits</a></td>
            <td><a href="majProduit.php?id_maj=<?= $row['id_produit'] ?>" class="btn btn-info">Mettre à jour le produits</a></td>
            <td><a href="suprProduit.php?id=<?= $row['id_produit'] ?>" class="btn btn-danger">Supprimer le produits</a></td>
        </tr>
        <?php

}

?>
    </tbody>
    </table>


</div>
<?php
//$content de template.php definis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation. 
//Si la temporisation n'est pas activée, alors false sera retourné.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";
