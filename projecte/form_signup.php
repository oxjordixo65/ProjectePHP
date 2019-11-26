<?php

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilos.css" type="text/css">
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <header>
        <img class="center margenArriba" src="img/icon.png" alt="iconImg" width="80" height="80">   
        <h1 class="text-center">Sign Up</h1>
    </header>
    <form class="text-center" action="http://localhost/projecte/signup.php" method="POST">
        <div class="form-group centrado">
            
            <label class="alinearIz" for="username" >Username</label><br>
            <input type="text" name="username" value="">
            <br>
            <label class="alinearIz" for="passw" >Password</label><br>
            <input type="password" name="passw" value="">
            <br><br>
            <input class="btn btn-primary btnGrande" type="submit" value="Crear">
        </div>
    </form>


    




</body>

</html>