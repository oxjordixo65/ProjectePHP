<?php
    require "fpdf.php";

    session_start();

    function printPDF(){
        $avui = date("F j, Y, g:i a");
        $numFactura = rand(10000, 99999);
        $arxiuConcerts = fopen("./concerts/concerts.txt", "r") or die("No s'ha pogut llegir l'arxiu d'informació!");

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell('', '', $avui, 0, 1, 'R');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(60, 10, 'JB Concerts');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(40, 10, 'Factura #'.$numFactura);
        $pdf->Ln();
        $pdf->Ln();
        //$pdf->Cell($pdf->GetPageWidth() - 50, $pdf->GetPageHeight() - 80, '',1,1,'C');

        for ($i = 1; $i <= 10; $i++) {
            if (isset($_SESSION["concert-" . $i])) {
                $concertInfo = fgets($arxiuConcerts);
                $concertTitol = explode("\t", $concertInfo)[0];
                $concertPreu = explode("\t", $concertInfo)[1];

                $pdf->SetFont('Arial', 'B', 11, 0, 0, '');
                $pdf->Cell('','',$concertTitol);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell('','',$concertPreu, 0, 0, '');
            }
        }

        $pdf->Output(); //this()->DIR_PRINT."/factura".$numFactura.".pdf","F"
        fclose($arxiuConcerts);
        return 0;
    }
    
    if (isset($_GET['pdf'])){
        printPDF();
    }
    
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Productes</title>
    <link rel="stylesheet" href="./css/cistella.css">
</head>

<body>
    <?php
    if (isset($_SESSION)) {
        $arxiuConcerts = fopen("./concerts/concerts.txt", "r") or die("No s'ha pogut llegir l'arxiu d'informació!");
        for ($i = 1; $i <= 10; $i++) {
            $concertInfo = fgets($arxiuConcerts);
            $concertTitol = explode("\t", $concertInfo)[0];

            # Si la sessió conté tickets marcats a la cistella, es marquen a la pàgina també
            if (isset($_SESSION["concert-" . $i]) && $_SESSION["concert-" . $i] != 0) {
                echo ('<div class="producte">');
                echo ('<img src="./img/concert-' . $i . '.jpg">');
                echo ('<span class="concert-titol">' . $concertTitol . '</span>');
                echo ('<span class="concert-quantitat">' . $_SESSION["concert-" . $i] . '</span>');
                echo ('</div>');
                echo ('<hr>');
            }
        }

        fclose($arxiuConcerts);
    }
    ?>
    <div id="botons">
        <a href="./productes.php"><button>Tornar als productes</button></a>
        <button>Fer pagament</button>
        <a href='cistella.php?pdf=true'><button>Descarrega PDF de la comanda</button></a>
    </div>
</body>

</html>