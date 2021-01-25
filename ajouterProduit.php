<?php
ob_start();
//Ici $title de template.php dans la balise <title><?= $title ></title>
$title = "Ecommerce - AJOUTER UN PRODUITS -";


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


?>


<h1 class="text-center">AJOUTER UN PRODUIT</h1>

<form action="enregistrerProduit.php" method="post">

    <!--NOM DU PRODUIT-->
    <div class="form-group">
        <label for="nom_produit">Nom du produit</label>
        <input type="text" pattern="^[A-Za-z '-]+$" class="form-control" id="nom_produit" name="nom_produit" required>
    </div>

    <!--DESCRIPTION DU PRODUIT-->
    <div class="form-group">
        <label for="description_produit">Description du produit</label>
        <textarea rows="5" class="form-control" id="description_produit" name="description_produit" required></textarea>
    </div>

    <!--IMAGE DU PRODUIT-->
    <div class="form-group">
        <label for="image_produit">Image du produit</label>
        <input type="text" class="form-control" id="image_produit" name="image_produit" required>
    </div>

    <!--PRIX DU PRODUIT-->
    <div class="form-group">
        <label for="prix_produit">Prix du produit</label>
        <input type="number" min="1" max="10000000000" class="form-control" id="prix_produit" name="prix_produit" required>
    </div>
    

    <div class="form-group">
        <button type="submit" class="btn btn-outline-success">Ajouter le produit</button>
    </div>

</form>

<?php
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


$content = ob_get_clean();
require "template.php";