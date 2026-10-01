<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class m_pdf {
    
    function __construct()
    {
        $CI = & get_instance();
        //log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
         
        if ($params == NULL)
        {
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';          		
        }
         
        //return new mPDF($param);
        return new mPDF();
		
		/*require_once APPPATH.'/third_party/mpdf-master/vendor/autoload.php';
		
		//$mpdf = new \Mpdf\Mpdf();
		//$mpdf =  new \Mpdf\Mpdf();
		
		$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];
		
		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];
		
		$mpdf = new \Mpdf\Mpdf([
			'fontDir' => array_merge($fontDirs, [
				APPPATH . '/third_party/mpdf-master/ttfonts',
			]),
			'fontdata' => $fontData + [
				'arial' => [
					'R' => "arial.ttf",
					'B' => "Arial Bold.ttf",
					'I' => "Arial Italic.ttf",
					'BI' => "Arial Bold Italic.ttf",
					'useOTL' => 0xFF,
        			//'useKashida' => 75,
				]
			],
			'default_font' => 'arial'
		]);
		return $mpdf;*/
    }

	function generate(){
		require_once APPPATH.'/third_party/mpdf-master/vendor/autoload.php';
		$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];
		
		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'stretch', 
			'format' => 'A4',
			'autoMarginPadding' => 1,
			'margin_left ' => 1,
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
		require_once APPPATH.'/third_party/mpdf-master/vendor/autoload.php';
		$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];
		
		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'stretch', 
			'format' => 'A4',
			'autoMarginPadding' => 1,
			'margin_top' => 45,
			'margin_left' => 14,
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
		require_once APPPATH.'/third_party/mpdf-master/vendor/autoload.php';
		$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];
		
		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'stretch', 
			'format' => 'A4',
			'autoMarginPadding' => 1,
			'margin_top' => 10,
			'margin_left' => 15,
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
		require_once APPPATH.'/third_party/mpdf-master/vendor/autoload.php';
		$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];
		
		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'stretch', 
			'format' => 'A4-L',
			'autoMarginPadding' => 1,
			'margin_left ' => 1,
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