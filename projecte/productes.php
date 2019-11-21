<?php
# TODO:
# Si se actualiza una cantidad de un producto que ya se había sumado, no se suma a la cantidad que ya se tiene
session_start();
if (isset($_SESSION)) {
    if (!isset($_SESSION["quantitat-productes"])) {
        $_SESSION["quantitat-productes"] = 0; # AIXÒ S'HA DE FER QUAN S'INICII LA SESSIÓ! (login)
    } else {

        for ($i = 1; $i <= 10; $i++) {
            # Guarda els concerts i la quantitat de tickets que ha escollit l'usuari
            # a $_SESSION.
            if (isset($_POST["chb-concert-" . $i]) && $_POST["chb-concert-" . $i] == "on") {
                if ($_POST["qt-concert-" . $i] != 0) {
                    # Si ja existeix una quantitat de tickets d'aquest concert, i 
                    # si el valor no ha canviat, no s'han de sumar més.
                    if (isset($_SESSION["concert-" . $i])) {
                        if ($_SESSION["concert-" . $i] != $_POST["qt-concert-" . $i]) {
                            $_SESSION["quantitat-productes"] -= $_SESSION["concert-" . $i];
                            $_SESSION["concert-" . $i] = $_POST["qt-concert-" . $i];
                            $_SESSION["quantitat-productes"] += $_POST["qt-concert-" . $i];
                        }
                    } else {
                        $_SESSION["concert-" . $i] = $_POST["qt-concert-" . $i];
                        $_SESSION["quantitat-productes"] += $_POST["qt-concert-" . $i];
                    }
                }
            } else {
                # Si no està marcat i existeix en la SESSIO, esborrar i eliminar la quantitat de la cistella
                if (isset($_SESSION["concert-" . $i])) {
                    $_SESSION["quantitat-productes"] -= $_SESSION["concert-" . $i];
                    $_SESSION["concert-" . $i] = 0;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Productes</title>
    <link rel="stylesheet" href="./styles.css">
</head>

<body>
    <form action="./productes.php" method="post">
        <input id="bt-actualitza-cistella" type="submit" value="Actualitzar cistella">
        <a id="link-cistella" href="./cistella.php">
            <div class="cistella">
                <p>Cistella</p>
                <span id="quantitat-cistella">
                    <?php if (isset($_SESSION)) echo ($_SESSION["quantitat-productes"]) ?>
                </span>
            </div>
        </a>

        <div class="productes">
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo ('<div class="producte">');

                # Si la sessió conté tickets marcats a la cistella, es marquen a la pàgina també
                if (isset($_SESSION["concert-" . $i])) {
                    if ($_SESSION["concert-" . $i] == 0) {
                        echo ('<input type="checkbox" name="chb-concert-' . $i . '">');
                    } else {
                        echo ('<input type="checkbox" name="chb-concert-' . $i . '" checked>');
                    }
                    echo ('<p> Descripció </p> <img src="./img/mono.jpg"><input type="number" name="qt-concert-' . $i . '" value="' . $_SESSION["concert-" . $i] . '"><br>');
                } else {
                    echo ('<input type="checkbox" name="chb-concert-' . $i . '">');
                    echo ('<p> Descripció </p> <img src="./img/mono.jpg"><input type="number" name="qt-concert-' . $i . '" value="0"><br>');
                }

                echo ('</div>');
            }
            ?>
        </div>
    </form>
</body>

</html>