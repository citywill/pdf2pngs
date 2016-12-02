# pdf2png

## 环境
ubuntu
```
sudo apt-get install php-imagick
sudo service apache2 reload
```

## 使用
```
include 'PdfToPng.php';

$pdfPath = './pdf';
$pdf = $pdfPath . '/tet.pdf';

$pngPath = './png/test';

$p2p = new PdfToPng($pdf, $pngPath);

$pngs = $p2p->getPngs();

print_r($pngs);

/*
输出结果：
array(
    '000.png',
    '001.png',
    '002.png',
    '003.png',
)
*/
```