<?php
//error_reporting(0);
require 'vendor/autoload.php'; // Load Composer's autoloader
require_once __DIR__ . "/../../modules/database/database.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$db = new Database();

 //Set document properties
$spreadsheet->getProperties()->setCreator('Your Name')
    ->setLastModifiedBy('Your Name')
    ->setTitle('Sample Excel Document')
    ->setSubject('Sample Excel Document')
    ->setDescription('A sample document created using PhpSpreadsheet.')
    ->setKeywords('php phpspreadsheet excel')
    ->setCategory('Sample');

// Add some data
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'ردیف'); // Set value in cell A1
$sheet->setCellValue('B1', 'نام و نام خانوادگی'); // Set value in cell A2
$sheet->setCellValue('C1', 'شماره ملی'); // Set value in cell A2
$sheet->setCellValue('D1', 'شماره دانشجویی'); // Set value in cell A2
$sheet->setCellValue('E1', 'مبلغ (ریال)'); // Set value in cell A2
$sheet->setCellValue('F1', 'شماره پیگیری'); // Set value in cell A2
$sheet->setCellValue('G1', 'تاریخ'); // Set value in cell A2
$sheet->setCellValue('H1', 'ساعت'); // Set value in cell A2
$data = $db->join(['payment', 'registration'], "INNER", 'st_id_no', ['payment.course_code' => $_GET['code']])['result'];
//print_r($data);
$counter = 1;
foreach($data as $item){
    //echo $item['st_fname'] . "<br>";
    $counter++;
    $sheet->setCellValue('A' . $counter, $counter);
    $sheet->setCellValue('B' . $counter, $item['st_fname'] . " " . $item['st_lname']);
    $sheet->setCellValue('C' . $counter, $item['st_id_no']);
    $sheet->setCellValue('D' . $counter, $item['st_code']);
    $sheet->setCellValue('E' . $counter, $item['amount']);
    $sheet->setCellValue('F' . $counter, $item['transaction_id']);
    $sheet->setCellValue('G' . $counter, $item['date']);
    $sheet->setCellValue('H' . $counter, $item['time']);

}
// Save the file
$writer = new Xlsx($spreadsheet);
$filename = $db->read('courses', ['code' => $_GET['code']])[0]['title'] . ".xlsx";
header('Content-Description: File Transfer');

header('Content-Type: application/octet-stream');

header('Content-Disposition: attachment; filename="' . basename($filename) . '"');

header('Expires: 0');

header('Cache-Control: must-revalidate');

header('Pragma: public');

header('Content-Length: ' . filesize($filename));
readfile($filename);

// Save the file to output
$writer->save($filename);

