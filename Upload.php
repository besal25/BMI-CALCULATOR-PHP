<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include('dbconfig.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_excel_data'])) {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];

        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();
            $count = 0;

            foreach ($data as $row) {
                if ($count > 0) { // Skip the header row
                    $student_name = $row[1] !== null ? mysqli_real_escape_string($con, $row[1]) : null;
                    $height_cm = $row[2] !== null ? mysqli_real_escape_string($con, $row[2]) : null;
                    $weight_kg = $row[3] !== null ? mysqli_real_escape_string($con, $row[3]) : null;
                    $grade = $row[4] !== null ? mysqli_real_escape_string($con, $row[4]) : null;
                    $section = $row[5] !== null ? mysqli_real_escape_string($con, $row[5]) : null;
                    $dob_bs = $row[6] !== null ? mysqli_real_escape_string($con, $row[6]) : null;

                    // Calculate Age
                    $age = calculate_age_from_dob($dob_bs);

                    // Calculate BMI
                    $height_m = $height_cm / 100; // Convert cm to meters
                    if ($height_m != 0) {
                        $bmi = $weight_kg / ($height_m * $height_m);
                    } else {
                        $bmi = null; // or handle as needed
                    }

                    // Sanitize age and bmi
                    $age = mysqli_real_escape_string($con, $age);
                    $bmi = $bmi !== null ? mysqli_real_escape_string($con, $bmi) : null;

                    // Create the SQL query
                    $studentQuery = "INSERT INTO students (student_name, height_cm, weight_kg, grade, section, dob_bs, age, bmi, remarks) 
                                     VALUES ('$student_name', '$height_cm', '$weight_kg', '$grade', '$section', '$dob_bs', '$age', '$bmi', '')";

                    if (!mysqli_query($con, $studentQuery)) {
                        throw new Exception("Error inserting data: " . mysqli_error($con));
                    }
                } else {
                    $count++;
                }
            }

            $_SESSION['message'] = "Successfully Imported";
        } catch (Exception $e) {
            $_SESSION['message'] = "Error: " . $e->getMessage();
        }
    } else {
        $_SESSION['message'] = "Invalid File";
    }

    header('Location: index.php');
    exit(0);
}

// Function to calculate age from DOB (A.D)
function calculate_age_from_dob($dob) {
    // Assuming the dob is already in A.D.
    $dob_date = new DateTime($dob);
    $now = new DateTime();
    $interval = $now->diff($dob_date);
    return $interval->y;
}
?>
