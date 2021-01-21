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
            $db = new PDO("mysql:host=localhost;dbname=ecommerce;charset=utf8", "root", "");
            //Fonction static de la classe PDO pour debug la connexion en cas d'erreur
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<p class='alert-success p-5'>Salut c bon t connecté a PDO MySQL</p>";
    }catch(PDOException $exception){
        die("Erreur de connexion a PDO MySQL :" .$exception->getMessage());
    }


?>

<h1 class="text-warning text-info">BAZAR.COM</h1>
<h2 class="text-warning text-info">Votre espace d'administration</h2>
<?php
//La requète sql stockée dans dans une variable
$sql = "SELECT * FROM produits";
//creation d'une variable qui stocke la connexion a PDO et l'execution de la requète SQL
$req = $db->query($sql);

//Boucle de lecture (connexion = $db + fonction query() PDO + requète SQL = $row)
foreach($db->query("SELECT * FROM produits") as $row){
    //Creation d'une liste pour chaque elements
    ?>

    <ul>
    <!--Appel des $row + nom de l'objet de la table produits-->
        <li>NOM DU PRODUITS : <?php echo $row['nom_produit'] ?></li>
        <li><img src="<?= $row['image_produit'] ?>" alt="<?= $row['nom_produit'] ?>" title="<?= $row['nom_produit'] ?>" /></li>
        <li>DESCRIPTION DU PRODUITS : <?php echo $row['description_produit'] ?></li>
        <li>PRIX DU PRODUITS : <?php echo $row['prix_produit'] ?> €</li>
    </ul>
    <?php

}

?>
<?php
//$content de template.php definis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation. 
//Si la temporisation n'est pas activée, alors false sera retourné.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";
