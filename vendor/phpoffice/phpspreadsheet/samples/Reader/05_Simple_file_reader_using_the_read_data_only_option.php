<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

require __DIR__ . '/../Header.php';

$inputFileType = 'Xls';
$inputFileName = __DIR__ . '/sampleData/example1.xls';

$reader = IOFactory::createReader($inputFileType);

$reader->setReadDataOnly(true);

$spreadsheet = $reader->load($inputFileName);


$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

var_dump($sheetData);
