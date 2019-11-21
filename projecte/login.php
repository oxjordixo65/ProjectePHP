<?php
    require('Usuari.php');

    //echo ($_POST['usernameLogin'].$_POST['passwLog']);
    Usuari::comprobarLogin($_POST["usernameLogin"],$_POST["passwLog"]);
   
    
?>