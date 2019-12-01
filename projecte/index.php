<?php

session_start();
setcookie(session_id(), '', time() + 31556952); // Caduca en un any

// quan es torna a l'index des de la pàgina de productes, com que la sessió
// havia començat i s'havia assignat un ID, isset($_SESSION) retornarà true. 
// Per tant, entrarà aquí i eliminarà la sessió.
if (isset($_SESSION["usuari"])) {
    session_unset(); //Esborrant totes les dades de la sessió    
    setcookie(session_id(), '', time() - 42000); // Destrucció cookie de sessió
    session_destroy(); //Destrucció de la sessió actual
    echo "S'ha tancat la sessió.";
}
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
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src="img/icon.png" alt="iconImg" width="65" height="60"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./llistaUsers.php">Llista Users</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Assignatures
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">PHP</a>
                        <a class="dropdown-item" href="#">Git</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">C++</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Nosaltres</a>
                </li>
            </ul>
            <form class="form-inline">

                <a href="./form_signup.php" class="btn btn-dark" role="button">Sign Up</button></a>
                &nbsp;&nbsp;
                <a href="./form_login.php" class="btn btn-dark" role="button">Login</button></a>
            </form>


        </div>
    </nav>





    <!--
    <img id="conciertoImg" src="img/background.jpg">-->

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner white">
            <div class="carousel-item active">
                <img class="d-block w-100" src="./img/background.jpg" alt="First slide">
                <div class="carousel-caption">
                    <h5>Image 1</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit condimentum ullamcorper magnis, metus varius blandit scelerisque suspendisse platea a leo morbi maecenas ac, tellus torquent erat mus vitae phasellus vivamus montes dapibus. Sociis iaculis cubilia magna placerat duis nulla proin sagittis convallis facilisi feugiat aenean, interdum habitasse tristique maecenas fermentum erat hendrerit vivamus massa eros turpis nec metus, himenaeos nibh malesuada luctus dui phasellus dictum ad in orci mollis. Fermentum curae porta condimentum tempus sem nisi inceptos eu primis, malesuada scelerisque pellentesque platea nibh turpis convallis hendrerit, habitant libero laoreet parturient at sagittis vel diam.

                        Tellus integer quis ullamcorper urna proin risus, malesuada consequat vestibulum dui potenti, massa mus nibh turpis pharetra. Lobortis id interdum bibendum nec elementum arcu, nullam suscipit donec imperdiet aptent, dui duis cubilia libero laoreet. Magna at pellentesque eget feugiat scelerisque cras, consequat eleifend maecenas non porta cubilia suspendisse, litora euismod ante nec fusce.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./img/background2.jpg" alt="Second slide">
                <div class="carousel-caption">
                    <h5>Image 2</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit condimentum ullamcorper magnis, metus varius blandit scelerisque suspendisse platea a leo morbi maecenas ac, tellus torquent erat mus vitae phasellus vivamus montes dapibus. Sociis iaculis cubilia magna placerat duis nulla proin sagittis convallis facilisi feugiat aenean, interdum habitasse tristique maecenas fermentum erat hendrerit vivamus massa eros turpis nec metus, himenaeos nibh malesuada luctus dui phasellus dictum ad in orci mollis. Fermentum curae porta condimentum tempus sem nisi inceptos eu primis, malesuada scelerisque pellentesque platea nibh turpis convallis hendrerit, habitant libero laoreet parturient at sagittis vel diam.

                        Tellus integer quis ullamcorper urna proin risus, malesuada consequat vestibulum dui potenti, massa mus nibh turpis pharetra. Lobortis id interdum bibendum nec elementum arcu, nullam suscipit donec imperdiet aptent, dui duis cubilia libero laoreet. Magna at pellentesque eget feugiat scelerisque cras, consequat eleifend maecenas non porta cubilia suspendisse, litora euismod ante nec fusce.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./img/background3.jpg" alt="Third slide">
                <div class="carousel-caption">
                    <h5>Image 3</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit condimentum ullamcorper magnis, metus varius blandit scelerisque suspendisse platea a leo morbi maecenas ac, tellus torquent erat mus vitae phasellus vivamus montes dapibus. Sociis iaculis cubilia magna placerat duis nulla proin sagittis convallis facilisi feugiat aenean, interdum habitasse tristique maecenas fermentum erat hendrerit vivamus massa eros turpis nec metus, himenaeos nibh malesuada luctus dui phasellus dictum ad in orci mollis. Fermentum curae porta condimentum tempus sem nisi inceptos eu primis, malesuada scelerisque pellentesque platea nibh turpis convallis hendrerit, habitant libero laoreet parturient at sagittis vel diam.

                        Tellus integer quis ullamcorper urna proin risus, malesuada consequat vestibulum dui potenti, massa mus nibh turpis pharetra. Lobortis id interdum bibendum nec elementum arcu, nullam suscipit donec imperdiet aptent, dui duis cubilia libero laoreet. Magna at pellentesque eget feugiat scelerisque cras, consequat eleifend maecenas non porta cubilia suspendisse, litora euismod ante nec fusce.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>