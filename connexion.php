<?php
ob_start();
//Page de traitement de la connexion
//Creer un faux utilisateur
$email_valide = "admin@admin.com";
$mot_de_passe_valide = "admin";


//Verification de l'existence des variables et le champ n'est pas vide
if(isset($_POST['email']) && !empty($_POST['email'])  && isset($_POST['password']) && !empty($_POST['password'])){
    //Test de debug
    var_dump($_POST['email']);
    var_dump($_POST['password']);
    //La condition est reussie on assigne l'element posté a la fausse vaiable
    if($email_valide == $_POST['email'] && $mot_de_passe_valide  == $_POST['password']){
        //La connexion est réussie et on affiche la page listeProduit.php
        session_start();
        //On utilise la super glogale $_SESSION[''] qui est egale au element valide ($email_valide et $mot_de_passe_valide)
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        //Rediection en php mettre url entière
        header('Location: http://localhost/Ecommerce/listeProduit.php');
    }else{
        //Si un champ est vide ou email mot de passe invalide
        echo "<p class='alert-danger p-5'>Erreur votre email ou mot de passe sont invalide ou des sont vide</p>";
        echo "<a href='index.php' class='btn btn-danger'>Retour</a>";
    }
}else{
    //Si un champ est vide ou email mot de passe invalide
    echo "<p class='alert-warning p-5'> ERREUR : Merci de renter un email et mot de passe valide ou de remplir tous les champ</p>";
    echo "<a href='index.php' class='btn btn-danger'>Retour</a>";
}

//Debug de session
var_dump($_SESSION['email']);
var_dump($_SESSION['password']);



//$content de template.php definis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation.
//Si la temporisation n'est pas activée, alors false sera retourné.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";



