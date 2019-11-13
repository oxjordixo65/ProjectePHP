<?php
    session_start();
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Productes</title>
    <link rel="stylesheet" href="./cistella.css">
</head>

<body>
    <?php
        if (isset($_SESSION)) {
            for ($i = 1; $i <= 10; $i++) {
                echo ('<div class="producte">');
                # Si la sessió conté tickets marcats a la cistella, es marquen a la pàgina també
                if (isset($_SESSION["concert-" . $i])) {
                    echo ('<p> Descripció </p> <img src="./img/mono.jpg"><input type="number" name="qt-concert-' . $i . '" value="' . $_SESSION["concert-" . $i] . '"><br>');
                }
                echo ('</div>');
            }
        }
    ?>
    <button>Fer pagament</button>
    <button>Descarrega PDF de la comanda</button>
</body>

</html>