<?php

include 'PdfToPng.php';

$pdfPath = './pdf';
$pdf = $pdfPath . '/' . $_GET['file'];
$pngPage = $_GET['page'] ? $_GET['page'] : '0';

$pngPath = './png/' . $_GET['file'];

$p2p = new PdfToPng($pdf, $pngPath);

$pngs = $p2p->getPngs();

foreach ($pngs as $page => $name) {
    echo '<a href="png.php?file=' . $_GET['file'] . '&page=' . $page . '">' . $name . '</a> ';
}

echo '<p><img src="' . $pngPath . '/' . $pngs[$pngPage] . '"></p>';
