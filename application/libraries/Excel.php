<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  

require_once APPPATH . "/third_party/PhpSpreadsheet/vendor/autoload.php";

if (!class_exists('PHPExcel_Style_Alignment', false)) {
    class_alias(\PhpOffice\PhpSpreadsheet\Style\Alignment::class, 'PHPExcel_Style_Alignment');
}
if (!class_exists('PHPExcel_IOFactory', false)) {
    class PHPExcel_IOFactory {
        public static function createWriter(\PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet, $writerType = '') {
            if (strcasecmp($writerType, 'Excel5') === 0 || strcasecmp($writerType, 'xls') === 0) {
                $writerType = 'Xls';
            } elseif (strcasecmp($writerType, 'Excel2007') === 0 || strcasecmp($writerType, 'xlsx') === 0) {
                $writerType = 'Xlsx';
            }
            return \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $writerType);
        }

        public static function load($pFilename) {
            return \PhpOffice\PhpSpreadsheet\IOFactory::load($pFilename);
        }

        public static function identify($pFilename) {
            return \PhpOffice\PhpSpreadsheet\IOFactory::identify($pFilename);
        }

        public static function createReader($readerType) {
            if (strcasecmp($readerType, 'Excel5') === 0) {
                $readerType = 'Xls';
            } elseif (strcasecmp($readerType, 'Excel2007') === 0) {
                $readerType = 'Xlsx';
            }
            return \PhpOffice\PhpSpreadsheet\IOFactory::createReader($readerType);
        }

        public static function createReaderForFile($pFilename) {
            return \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($pFilename);
        }
    }
}
if (!class_exists('PHPExcel_Shared_Date', false)) {
    class_alias(\PhpOffice\PhpSpreadsheet\Shared\Date::class, 'PHPExcel_Shared_Date');
}

#[\AllowDynamicProperties]
class Excel extends \PhpOffice\PhpSpreadsheet\Spreadsheet {
    public function __construct() {
        parent::__construct();
    }

    public function read_file($file) {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $header = array();
        $arr_data = array();

        foreach ($worksheet->getRowIterator() as $row) {
            $rowIndex = $row->getRowIndex();
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            foreach ($cellIterator as $cell) {
                $column = $cell->getColumn();
                $data_value = $cell->getValue();

                if ($rowIndex == 1) {
                    $header[$column] = $data_value;
                } else {
                    if (trim((string)$data_value) !== '' && \PhpOffice\PhpSpreadsheet\Shared\Date::isDateTime($cell)) {
                        $format = 'Y-m-d H:i:s';
                        $date = @\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data_value);
                        if ($date) {
                            $data_value = $date->format($format);
                        }
                    }
                    $arr_data[$rowIndex][$column] = $data_value;
                }
            }
        }

        return array('header' => $header, 'values' => $arr_data);
    }

    public function create_file() {
        $this->setActiveSheetIndex(0);
        $this->getActiveSheet()->setTitle('test worksheet');
        $this->getActiveSheet()->setCellValue('A1', 'This is just some text value');
        $this->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $this->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->getActiveSheet()->mergeCells('A1:D1');
        $this->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $filename = 'just_some_random_name.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($this);
        $writer->save('php://output');
        exit;
    }
}