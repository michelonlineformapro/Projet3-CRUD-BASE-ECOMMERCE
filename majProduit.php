<?php
ob_start();
//Ici $title de template.php dans la balise <title><?= $title ></title>
$title = "Ecommerce - METTRE A JOUR UN PRODUITS -";


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
    echo "<p class='alert-success p-5'>Connexion à PDO MySQL</p>";
}catch(PDOException $exception){
    die("Erreur de connexion a PDO MySQL :" .$exception->getMessage());
}

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

if($resultat){
    ?>
<h1 class="text-center">METTRE UN PRODUIT</h1>
<!-- Appel de la page du traitement du formulaire-->
<form action="valider_majProduit.php?id_maj=<?= $resultat['id_produit'] ?>" method="post">

    <!--NOM DU PRODUIT-->
    <div class="form-group">
        <!--ICI on recup l'attibut name et sa valeur avec $_POST['nom_produit']-->
        <label for="nom_produit">Nom du produit</label>
        <input type="text" value="<?= $resultat['nom_produit'] ?>"  class="form-control" id="nom_produit" name="nom_produit" required>
    </div>

    <!--DESCRIPTION DU PRODUIT-->
    <div class="form-group">
        <!--ICI on recup l'attibut name et sa valeur avec $_POST['description_produit']-->
        <label for="description_produit">Description du produit</label>
        <textarea  rows="5" class="form-control" id="description_produit" name="description_produit" required><?= $resultat['description_produit'] ?></textarea>
    </div>

    <!--IMAGE DU PRODUIT-->
    <div class="form-group">
        <label for="image_produit">Image du produit</label>
        <!--ICI on recup l'attibut name et sa valeur avec $_POST['image_produit']-->
        <input type="text" value="<?= $resultat['image_produit'] ?>" class="form-control" id="image_produit" name="image_produit" required>
    </div>

    <!--PRIX DU PRODUIT-->
    <div class="form-group">
        <label for="prix_produit">Prix du produit</label>
        <!--ICI on recup l'attibut name et sa valeur avec $_POST['prix_produit']-->
        <input type="text" value="<?= $resultat['prix_produit'] ?>"  step="4" class="form-control" id="prix_produit" name="prix_produit" required>
    </div>


    <div class="form-group mt-5">
        <!--ICI  le type submit appel le l'atribut action= du formulaire-->
        <button type="submit" class="btn btn-outline-success">Mettre à jour le produit</button>
    </div>

</form>

<?php
}
/*
//Recupation de input name = nom du produit
$nom_produit = $_POST['nom_produit'];
$description_produit = $_POST['description_produit'];
$image_produit = $_POST['image_produit'];
$prix_produit = $_POST['prix_produit'];
//Afficher les valeur récupée du formulaire
var_dump($nom_produit);
var_dump($description_produit);
var_dump($image_produit);
var_dump($prix_produit);
*/
//Appel du template
$content = ob_get_clean();
require "template.php";

