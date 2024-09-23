<?php
require 'vendor/autoload.php'; // Include Composer's autoload file
require 'dbconfig.php'; // Ensure this file exists and contains the correct database connection setup

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$sql = "SELECT * FROM students";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set column headers
    $headers = ['S.N', 'Name', 'Height (cm)', 'Weight (kg)', 'Grade', 'Section', 'DOB (B.S)', 'Age', 'BMI', 'Remarks'];
    $column = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($column . '1', $header);
        $column++;
    }

    $rowCount = 2;
    $sn = 1;

    while ($row = $result->fetch_assoc()) {
        $column = 'A';
        $sheet->setCellValue($column . $rowCount, $sn++);
        $column++;
        $sheet->setCellValue($column . $rowCount, htmlspecialchars($row["student_name"]));
        $column++;
        $sheet->setCellValue($column . $rowCount, htmlspecialchars($row["height_cm"]));
        $column++;
        $sheet->setCellValue($column . $rowCount, htmlspecialchars($row["weight_kg"]));
        $column++;
        $sheet->setCellValue($column . $rowCount, htmlspecialchars($row["grade"]));
        $column++;
        $sheet->setCellValue($column . $rowCount, htmlspecialchars($row["section"]));
        $column++;
        $sheet->setCellValue($column . $rowCount, htmlspecialchars($row["dob_bs"]));
        $column++;
        $sheet->setCellValue($column . $rowCount, htmlspecialchars($row["age"]));
        $column++;
        $sheet->setCellValue($column . $rowCount, htmlspecialchars($row["bmi"]));
        $column++;
        $sheet->setCellValue($column . $rowCount, htmlspecialchars($row["remarks"]));
        $rowCount++;
    }

    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="students_data.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit();
} else {
    echo "No records found.";
}

$con->close();
?>
