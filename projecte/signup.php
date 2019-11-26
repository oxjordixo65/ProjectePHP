<?php

    require("Usuari.php");
    $usuari=new Usuari($_POST["username"],$_POST["passw"]);
    $usuari->registrar();
    
?>

