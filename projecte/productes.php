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
            if (isset($_POST["chb-concert-" . $i]) && $_POST["chb-concert-" . $i] == "on") { //isset para mirar si almenos a variable existe, sino ya ni mira el valor=on

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
        <input id="bt-actualitza-cistella" type="submit" value="Actualitzar cistella"><br><br><br><br><br>
        <a id="link-cistella" href="./cistella.php">
            <div class="cistella">
                <img src="img/shopping-cart.png" id="img-shopping-cart">
                <span id="quantitat-cistella">
                    <?php if (isset($_SESSION)) echo ($_SESSION["quantitat-productes"]) ?>
                </span>
            </div>
        </a>

        <div class="productes">
            <?php
            # Llegeix l'arxiu amb la info dels concerts (títol i preu)
            $arxiuConcerts = fopen("./concerts/concerts.txt", "r") or die("No s'ha pogut llegir l'arxiu d'informació!");

            for ($i = 1; $i <= 10; $i++) {
                $concertInfo = fgets($arxiuConcerts);
                $concertTitol = explode("\t", $concertInfo)[0];
                $concertPreu = explode("\t", $concertInfo)[1];
                echo ('<div class="producte">');
                echo('<img src="./img/concert-' . $i . '.jpg">');
                echo('<span class="concert-titol">'.$concertTitol.'</span>');
                echo('<span class="concert-preu">'.$concertPreu.'€</span>');

                # Si la sessió conté tickets marcats a la cistella, es marquen a la pàgina també
                if (isset($_SESSION["concert-" . $i])) {
                    if ($_SESSION["concert-" . $i] == 0) {
                        echo ('<input type="checkbox" name="chb-concert-' . $i . '">');
                    } else {
                        echo ('<input type="checkbox" name="chb-concert-' . $i . '" checked>');
                    }
                    echo ('<input type="number" name="qt-concert-' . $i . '" value="' . $_SESSION["concert-" . $i] . '" max="10" min="0"><br>');
                } else {
                    echo ('<input type="checkbox" name="chb-concert-' . $i . '">');
                    echo ('<input type="number" name="qt-concert-' . $i . '" value="0" max="10" min="0"><br>');
                }

                echo ('</div>');
            }

            # Tanca l'arxiu d'informació
            fclose($arxiuConcerts);
            ?>
        </div>
    </form>
</body>

</html>