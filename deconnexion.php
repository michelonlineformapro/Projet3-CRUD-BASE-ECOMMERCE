<?php
//On demmare la session
session_start();

//On detruit les varaibles de session
session_unset();

//Destruire la session
session_destroy();

header("Location: http://localhost/ecommerce/index.php");


