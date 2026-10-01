<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
require_once APPPATH . "/libraries/Excel.php";
use PhpOffice\PhpSpreadsheet\IOFactory; 

#[\AllowDynamicProperties]
class Spreadsheet {
	public function __construct() {
		$CI =& get_instance();
		if (isset($CI->excel)) {
			$this->excel = $CI->excel;
		}
	}
	public function read_file($file){
		$spreadsheet = IOFactory::load($file);
		//$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		//$worksheet  = $spreadsheet->getActiveSheet();
		//return $sheetData;
		//$test = [];
		$rows = array('header'=>array(),'values'=>array());
		$header = [];
		
		for($i = 0; $i<$spreadsheet->getSheetCount(); $i++){
			$worksheet  = $spreadsheet->getSheet($i);
			foreach ($worksheet ->getRowIterator() AS $row) {
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
				$cells = [];
				foreach ($cellIterator as $cell) {
					$value = $org_val = $cell->getValue();
					$is_date = preg_match('/(\d{1,4}[\/\-]{1}\d{1,2}[\/\-]{1}\d{1,4})/', $value);
					if(\PhpOffice\PhpSpreadsheet\Shared\Date::isDateTime($cell)){
						//$format = 'Y-m-d H:i:s';
						//$UNIX_DATE = ($value - 25569) * 86400;
						//$value = gmdate($format, $UNIX_DATE);
						$date = @\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
						$value = @$date->format('Y-m-d H:i:s');
					}
					if(empty($rows['header'])){
						$header[] = $org_val;
					}else{
						$cells[] = trim($value);
					}
				}
				if(empty($rows['header'])){
					$rows['header'] = $header;
					$header = [];
				}else{
					$rows['values'][] = $cells;
					//$test[] = $date;
					//$date = [];
				}
			}
		}
		return $rows;
		/*
		//$file = './files/test.xlsx';
		
		//read file from path
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		//get only the Cell Collection
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		 
		//extract to a PHP readable array format
		$header 	= array();
		$arr_data 	= array();
		foreach ($cell_collection as $cell) {
			$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
			$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
			$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
			$cell_dt = $objPHPExcel->getActiveSheet()->getCell($cell);
			//The header will/should be in row 1 only. of course, this can be modified to suit your need.
			if ($row == 1) {
				//$header[$row][$column] = $data_value;
				$header[$column] = $data_value;
			} else {
				if(trim($data_value) != '' && PHPExcel_Shared_Date::isDateTime($cell_dt)) {
					$format = 'Y-m-d H:i:s';
					//$data_value = date($format, PHPExcel_Shared_Date::ExcelToPHP($data_value)); 
					$UNIX_DATE = ($data_value - 25569) * 86400;
					$data_value = gmdate($format, $UNIX_DATE);
				}
				//$arr_data[$row][$column] = $data_value;
				$arr_data[$row][$column] = $data_value;
			}
		}
		 
		//send the data in an array format
		$data['header'] = $header;
		$data['values'] = $arr_data;
		return $data;*/
	}
	public function create_file(){
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 
		$filename='just_some_random_name.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function create_file_from_db(){
		 //activate worksheet number 1
		 $this->excel->setActiveSheetIndex(0);
		 //name the worksheet
		 $this->excel->getActiveSheet()->setTitle('Users list');
		 
		 // load database
		 $this->load->database();
		 
		 // load model
		 $this->load->model('userModel');
		 
		 // get all users in array formate
		 $users = $this->userModel->get_users();
		 
		 // read data to active sheet
		 $this->excel->getActiveSheet()->fromArray($users);
		 
		 $filename='just_some_random_name.xls'; //save our workbook as this file name
		 
		 header('Content-Type: application/vnd.ms-excel'); //mime type
		 
		 header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		 
		 header('Cache-Control: max-age=0'); //no cache
					 
		 //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		 //if you want to save it as.XLSX Excel 2007 format
		 
		 $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		 
		 //force user to download the Excel file without writing it to server's HD
		 $objWriter->save('php://output');
	}
}
