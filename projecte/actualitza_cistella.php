<?php
    session_start();
    # Es comprova si es té una sessió
    if (isset($_SESSION)) {
        for($i = 1; $i <= 10; $i++) {
            echo ("Checkbox value for concert nº".$i.": ".$_POST["chb-concert-".$i]."<br>");
            echo ("Quntity value for concert nº".$i.": ".$_POST["qt-concert-".$i]."<br><br>");
            # Guarda els concerts i la quantitat de tickets que ha escollit l'usuari
            # a $_SESSION.
            if ($_POST["chb-concert-".$i] == "on") {
                if ($_POST["qt-concert-".$i] != 0){
                    $_SESSION["concert-".$i] = $_POST["qt-concert-".$i];
                    $_SESSION["quantitat-productes"] += $_POST["qt-concert-".$i];
                }
                else {
                    # Si s'ha seleccionat un concert però la quantitat és zero,
                    # no s'ha de sumar res ni s'ha de guardar el concert a $_SESSION.
                    echo("Si es selecciona un ticket, no es pot posar com a quantitat 0! Ticket seleccionat amb quantitat zero: nº".$i);
                }
            }
        }

        echo("La quantitat actual de productes a la cistella és de: ".$_SESSION["quantitat-productes"]);
    }
?>
