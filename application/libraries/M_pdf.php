<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

#[\AllowDynamicProperties]
class m_pdf {
    
    function __construct()
    {
        $CI =& get_instance();
    }
 
    function load($param = NULL)
    {
        return $this->generate();
    }

	function generate(){
		require_once APPPATH . '/third_party/mpdf-master/vendor/autoload.php';
		$defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];
		
		$defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'stretch', 
			'format' => 'A4',
			'autoMarginPadding' => 1,
			'margin_left' => 1,
			'tempDir' => APPPATH . 'third_party/mpdf-master/tmp',
			'fontDir' => array_merge($fontDirs, [
				APPPATH . 'third_party/mpdf-master/ttfonts',
			]),
			'fontdata' => $fontData + [
				"arial" => array(
					'R' => "arial.ttf",
					'B' => "Arial Bold.ttf",
					'I' => "Arial Italic.ttf",
					'BI' => "Arial Bold Italic.ttf",
				),
			],
			'default_font' => 'arial',
			'autoLangToFont' => true
		]);
		$mpdf->SetDisplayMode('fullwidth');
		return $mpdf;
	}
	
	function letterPdfCreate(){
		require_once APPPATH . '/third_party/mpdf-master/vendor/autoload.php';
		$defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];
		
		$defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'stretch', 
			'format' => 'A4',
			'autoMarginPadding' => 1,
			'margin_top' => 45,
			'margin_left' => 14,
			'tempDir' => APPPATH . 'third_party/mpdf-master/tmp',
			'fontDir' => array_merge($fontDirs, [
				APPPATH . 'third_party/mpdf-master/ttfonts',
			]),
			'fontdata' => $fontData + [
				"arial" => array(
					'R' => "arial.ttf",
					'B' => "Arial Bold.ttf",
					'I' => "Arial Italic.ttf",
					'BI' => "Arial Bold Italic.ttf",
				),
			],
			'default_font' => 'arial',
			'autoLangToFont' => true
		]);
		$mpdf->SetDisplayMode('fullwidth');
		return $mpdf;
	}
	
	function letterTempCreate(){
		require_once APPPATH . '/third_party/mpdf-master/vendor/autoload.php';
		$defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];
		
		$defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'stretch', 
			'format' => 'A4',
			'autoMarginPadding' => 1,
			'margin_top' => 10,
			'margin_left' => 15,
			'tempDir' => APPPATH . 'third_party/mpdf-master/tmp',
			'fontDir' => array_merge($fontDirs, [
				APPPATH . 'third_party/mpdf-master/ttfonts',
			]),
			'fontdata' => $fontData + [
				"arial" => array(
					'R' => "arial.ttf",
					'B' => "Arial Bold.ttf",
					'I' => "Arial Italic.ttf",
					'BI' => "Arial Bold Italic.ttf",
				),
			],
			'default_font' => 'arial',
			'autoLangToFont' => true
		]);
		$mpdf->SetDisplayMode('fullwidth');
		return $mpdf;
	}
	
	function pdfgenerate(){
		require_once APPPATH . '/third_party/mpdf-master/vendor/autoload.php';
		$defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];
		
		$defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'stretch', 
			'format' => 'A4-L',
			'autoMarginPadding' => 1,
			'margin_left' => 1,
			'tempDir' => APPPATH . 'third_party/mpdf-master/tmp',
			'fontDir' => array_merge($fontDirs, [
				APPPATH . 'third_party/mpdf-master/ttfonts',
			]),
			'fontdata' => $fontData + [
				"arial" => array(
					'R' => "arial.ttf",
					'B' => "Arial Bold.ttf",
					'I' => "Arial Italic.ttf",
					'BI' => "Arial Bold Italic.ttf",
				),
			],
			'default_font' => 'arial',
			'autoLangToFont' => true
		]);
		$mpdf->SetDisplayMode('fullwidth');
		return $mpdf;
	}
}