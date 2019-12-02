<?php
require "fpdf.php";

session_start();

// Comprova que s'ha iniciat la sessió abans de carregar la pàgina.
// Si no s'ha iniciat, es redirigeix l'usuari a una altra
// on s'indica que s'ha d'iniciar sessió.
if (!isset($_SESSION["usuari"])) {
    header("Location: falla_auth.php");
}

$numFactura = rand(10000, 99999);
$arxiuConcerts = fopen("./concerts/concerts.txt", "r") or die("No s'ha pogut llegir l'arxiu d'informació!");

function printPDF($numFactura, $arxiuConcerts)
{
    $avui = date("F j, Y, g:i a");

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell('', '', $avui, 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(60, 10, 'JB Concerts');
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(40, 10, 'Factura #' . $numFactura);
    $pdf->Ln();
    $pdf->Ln();

    $totalPagament = 0;
    for ($i = 1; $i <= 10; $i++) {
        $concertInfo = fgets($arxiuConcerts);
        $concertTitol = explode("\t", $concertInfo)[0];
        $concertPreu = explode("\t", $concertInfo)[1];
        if (isset($_SESSION["concert-" . $i])) {
            $totalPagament += (int) $concertPreu * (int) $_SESSION["concert-" . $i];

            $pdf->SetFont('Arial', 'B', 11);
            $pdf->Cell(60, 10, $concertTitol, 0, 0, '');
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(60, 10, $_SESSION["concert-" . $i] . " x " . $concertPreu . " eur", 0, 1, 'C');
            $pdf->Ln();
        }
    }
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 13);
    $pdf->Cell('', '', "Total a pagar: " . $totalPagament . " euros", 0, 1, 'R');

    $pdf->Output(); //this()->DIR_PRINT."/factura".$numFactura.".pdf","F"
    fclose($arxiuConcerts);
    return 0;
}

function printDoc($numFactura, $arxiuConcerts)
{
    // Equival a fer el pagament de la comanda.
    // Genera un document de text al costat del servidor, a la carpeta principal de la pàgina,
    // i elimina les variables de sessió dels productes.

    $avui = date("Ymd");
    $arxiu = fopen('./comandes/'.$_SESSION["usuari"]. "_" . $avui . ".txt", 'a+') or die("No s'ha pogut crear/llegir l'arxiu $avui.txt!");

    fwrite($arxiu, "Factura #" . $numFactura . "\n\n");
    $totalPagament = 0;
    for ($i = 1; $i <= 10; $i++) {
        $concertInfo = fgets($arxiuConcerts);
        $concertTitol = explode("\t", $concertInfo)[0];
        $concertPreu = explode("\t", $concertInfo)[1];
        if (isset($_SESSION["concert-" . $i])) {
            $totalPagament += (int) $concertPreu * (int) $_SESSION["concert-" . $i];
            fwrite($arxiu, $concertTitol . "\t");
            fwrite($arxiu, $_SESSION["concert-" . $i] . " x " . $concertPreu . " eur\n");
            // elimina 
            unset($_SESSION["concert-" . $i]);
        }
    }

    fwrite($arxiu, "\nTotal a pagar: " . $totalPagament . "\n");
    fwrite($arxiu, "----------------------------------------\n");

    $_SESSION["quantitat-productes"] = 0;    
}

if (isset($_GET['pdf'])) {
    printPDF($numFactura, $arxiuConcerts);
}

if (isset($_GET['doc'])) {
    printDoc($numFactura, $arxiuConcerts);    
    sleep(3);
    header("Location: productes.php");
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
    if (isset($_GET["doc"])){
        echo "<p>S'ha completat la comanda i generat un document d'informació. <br> En 3 segons seràs redirigit a la pàgina de productes. Gràcies!</p>";
    }

    if (isset($_SESSION)) {
        $arxiuConcerts = fopen("./concerts/concerts.txt", "r") or die("No s'ha pogut llegir l'arxiu d'informació!");
        $totalPagament = 0;

        for ($i = 1; $i <= 10; $i++) {
            $concertInfo = fgets($arxiuConcerts);
            $concertTitol = explode("\t", $concertInfo)[0];
            $concertPreu = explode("\t", $concertInfo)[1];

            # Si la sessió conté tickets marcats a la cistella, es marquen a la pàgina també
            if (isset($_SESSION["concert-" . $i]) && $_SESSION["concert-" . $i] != 0) {
                $totalPagament += (int) $concertPreu * (int) $_SESSION["concert-" . $i];

                echo ('<div class="producte">');
                echo ('<img src="./img/concert-' . $i . '.jpg">');
                echo ('<span class="concert-titol">' . $concertTitol . '</span>');
                echo ('<span class="concert-quantitat">' . $_SESSION["concert-" . $i] . '</span>');
                echo ('</div>');
            }
        }

        fclose($arxiuConcerts);
        echo ('<p class="total-pagament" style="font-size:1em;font-weight:bold;text-align:center;">Total a pagar: ' . $totalPagament . "€</p>");
        echo ('<hr>');
    }
    ?>
    <div id="botons">
        <a href="./productes.php?return=true"><button>Tornar als productes</button></a>
        <a href="./cistella.php?doc=true"><button>Fer pagament</button></a>
        <a href='./cistella.php?pdf=true'><button>Descarrega PDF de la comanda</button></a>

    </div>
</body>

</html>