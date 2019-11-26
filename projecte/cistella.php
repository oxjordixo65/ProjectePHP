<?php
//require "fpdf.php";

session_start();
/*
    function printPDF($tipus,$dim,$volum,$forma){
        $cadena="Productes:\n\n";

        for ($i = 1; $i <= 10; $i++) {
            if (isset($_SESSION["concert-" . $i])) {
                $cadena="\tConcert nº ".$i." ";
            }
        }
        		
        echo $cadena."<br>";
        $cadena=utf8_decode($cadena);
        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Helvetica','',16);
        $pdf->Write(7,$cadena);
        $pdf->Output(self::DIR_PRINT."/".$forma.".pdf","F");
        return 0;
    }	
    */
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
        $arxiuConcerts = fopen("./concerts/concerts.txt", "r") or die("No s'ha pogut llegir l'arxiu d'informació!");
        for ($i = 1; $i <= 10; $i++) {
            $concertInfo = fgets($arxiuConcerts);
            $concertTitol = explode("\t", $concertInfo)[0];

            # Si la sessió conté tickets marcats a la cistella, es marquen a la pàgina també
            if (isset($_SESSION["concert-" . $i])) {
                echo ('<div class="producte">');
                echo ('<img src="./img/concert-' . $i . '.jpg">');
                echo ('<span class="concert-titol">' . $concertTitol . '</span>');
                echo ('<span class="concert-quantitat">' . $_SESSION["concert-" . $i] . '</span>');
                echo ('</div>');
                echo ('<hr>');
            }
        }
    }
    ?>
    <div id="botons">
        <button>Fer pagament</button>
        <button>Descarrega PDF de la comanda</button>
    </div>
</body>

</html>