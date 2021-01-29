<?php
$title = "Ecommerce - ACCEUIL -";
ob_start();
?>
    <h1 class="text-danger text-center">BAZAR.COM</h1>
    <div class="text-center" id="login-form">
        <form action="connexion.php" method="post">
            <div class="form-group">
                <label for="email">Votre email</label>
                <!-- ici l'attribut name = "" va etre recupérer par la variable super global $_POST['']-->
                <input type="email" id="email" class="form-control" name="email">
            </div>

            <!-- Le champ password-->
            <div class="form-group">
                <label for="password">Votre mot de passe</label>
                <!-- ici l'attribut name = "" va etre recupérer par la variable super global $_POST['']-->
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <!-- le bouton appel <form action="" le fichier connexion.php-->
            <button type="submit" class="btn btn-outline-info mt-5">CONNEXION</button>
        </form>

    </div>

<?php
var_dump($_POST['email']);
var_dump($_POST['password']);
$content = ob_get_clean();
require "template.php";