<?php

/**
 * Class PdfToPng
 */
class PdfToPng
{

    public $pdf;
    public $pngPath;
    public $pngs = array();

	/**
	 * PdfToPng constructor.
	 *
	 * @param string $pdf pdf文件路径
	 * @param string $pngPath 存放png目录
	 *
	 * @throws Exception
	 */
    public function __construct($pdf, $pngPath)
    {
        $this->pdf = $pdf;
        $this->pngPath = $pngPath;

        if (!file_exists($this->pdf)) {
            throw new \Exception('没有找到pdf文件');
        }

        if (!file_exists($this->pngPath . '/000.png')) {
            $this->generatePng();
        } else {
            $this->getPngs();
        }
    }

	/**
	 * 生成png文件并返回文件列表
	 * @return array png文件列表数组
	 * @throws Exception
	 */
    public function generatePng()
    {
        if (!extension_loaded('imagick')) {
            throw new \Exception('需要安装imagick扩展');
        }

        $imagick = new imagick();
        $imagick->setResolution(120, 120);
        $imagick->setCompressionQuality(100);
        $imagick->readImage($this->pdf);

        if (!is_dir($this->pngPath)) {
            mkdir($this->pngPath);
        }

        $i = 0;
        foreach ($imagick as $value) {
            $value->setImageFormat('png');
            $fileName = $this->pngPath . '/' . sprintf("%03d", $i) . '.png';
            if ($value->writeImage($fileName) == true) {
                $files[$i] = $fileName;
                $i++;
            }
        }

        //ksort($files);

        $this->pngs = $files;
        return $this->pngs;
    }

	/**
	 * 获得已经存在的png文件列表
	 * @return array png文件列表数组
	 */
    public function getPngs()
    {
        $files = scandir($this->pngPath);
        $files = array_diff($files, array('.', '..'));
        asort($files);
        $files = array_values($files);
        $this->pngs = $files;
        return $this->pngs;
    }
}
