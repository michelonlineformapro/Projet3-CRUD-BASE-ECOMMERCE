<?php
$title = "Ecommerce - ACCEUIL -";
ob_start();

?>
    <h1 class="text-danger text-center">BAZAR.COM</h1>
    <div class="text-center">
        <a href="listeProduit.php" class="btn btn-outline-info">CONNEXION</a>
    </div>

<?php
$content = ob_get_clean();
require "template.php";