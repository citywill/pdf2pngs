<?php

$pdfPath = './pdf';

$files = scandir($pdfPath);
$files = array_diff($files, array('.', '..'));

foreach ($files as $file) {
    echo '<p><a href="png.php?file=' . $file . '">' . $file . '</a></p>';
}
