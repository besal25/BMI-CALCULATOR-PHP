<?php
session_start();
include('dbconfig.php');

// Function to calculate age from DOB
function calculate_age($dob) {
    $dob_date = DateTime::createFromFormat('Y-m-d', $dob); // Adjust format as needed
    $today = new DateTime();
    $age = $today->diff($dob_date)->y;
    return $age;
}

// Handle deletion request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['student_id'])) {
    $student_id = intval($_POST['student_id']);

    // Delete query
    $query = "DELETE FROM students WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $student_id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = 'Record deleted successfully!';
        $_SESSION['message_type'] = 'success'; // Set message type
    } else {
        $_SESSION['message'] = 'Error deleting record: ' . mysqli_error($con);
        $_SESSION['message_type'] = 'error'; // Set message type
    }

    mysqli_stmt_close($stmt);

    // Redirect back to the main page to prevent form resubmission
    header('Location: index.php');
    exit();
}

// Handle new student form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_student'])) {
    $student_name = $_POST['student_name'];
    $height_cm = floatval($_POST['height_cm']);
    $weight_kg = floatval($_POST['weight_kg']);
    $grade = $_POST['grade'];
    $section = $_POST['section'];
    $dob_bs = $_POST['dob_bs'];

    // Calculate age from date of birth (DOB)
    $age = calculate_age($dob_bs);

    // Calculate BMI
    $bmi = ($weight_kg / ($height_cm * $height_cm)) * 10000; // BMI formula

    // Determine remarks based on BMI
    if ($bmi < 18.5) {
        $remarks = 'Underweight';
    } elseif ($bmi >= 18.5 && $bmi < 24.9) {
        $remarks = 'Normal weight';
    } elseif ($bmi >= 25 && $bmi < 29.9) {
        $remarks = 'Overweight';
    } else {
        $remarks = 'Obesity';
    }

    // Insert query
    $query = "INSERT INTO students (student_name, height_cm, weight_kg, grade, section, dob_bs, age, bmi, remarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "siiissids", $student_name, $height_cm, $weight_kg, $grade, $section, $dob_bs, $age, $bmi, $remarks);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = 'New record added successfully!';
        $_SESSION['message_type'] = 'success'; // Set message type
    } else {
        $_SESSION['message'] = 'Error adding record: ' . mysqli_error($con);
        $_SESSION['message_type'] = 'error'; // Set message type
    }

    mysqli_stmt_close($stmt);

    // Redirect back to the main page to prevent form resubmission
    header('Location: index.php');
    exit();
}

// Handle delete all request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_all'])) {
    // Confirm action to prevent accidental deletion
    if ($_POST['delete_all'] == '1') {
        $query = "TRUNCATE TABLE students";
        if (mysqli_query($con, $query)) {
            $_SESSION['message'] = 'All records deleted successfully!';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Error deleting all records: ' . mysqli_error($con);
            $_SESSION['message_type'] = 'error';
        }
        // Redirect to prevent resubmission
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data</title>
    <style>
        /* Your existing CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="file"],
        input[type="text"],
        input[type="number"] {
            margin-right: 10px;
            padding: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .btn-download,
        .btn-delete-all {
            background-color: #2196F3;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .btn-delete-all {
            background-color: #f44336;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .message {
            margin: 20px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            width: 300px;
            font-size: 16px;
            display: none; /* Initially hidden */
        }

        .message.success {
            background-color: #4CAF50;
            color: white;
        }

        .message.error {
            background-color: #f44336;
            color: white;
        }

        .fade-out {
            animation: fadeOut 3s forwards;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        .button-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .button-container form {
            display: inline-block;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <h1>Student Data</h1>

    <!-- Message Display -->
    <?php
    if (isset($_SESSION['message'])) {
        $message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'success'; // Default to success
        echo "<div id='message' class='message $message_type fade-out'>
            " . htmlspecialchars($_SESSION['message']) . "
        </div>";
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
    ?>

    <!-- Form to Add New Student -->
    <form action="" method="post">
        <h2>Add New Student</h2>
        <input type="text" name="student_name" placeholder="Name" required>
        <input type="number" step="0.01" name="height_cm" placeholder="Height (cm)" required>
        <input type="number" step="0.01" name="weight_kg" placeholder="Weight (kg)" required>
        <input type="text" name="grade" placeholder="Grade" required>
        <input type="text" name="section" placeholder="Section" required>
        <input type="date" name="dob_bs" placeholder="DOB (YYYY-MM-DD)" required>
        <input type="submit" name="add_student" value="Add Student">
    </form>

    <!-- Upload Form -->
    <form action="Upload.php" method="post" enctype="multipart/form-data" style="text-align: center;">
        <input type="file" name="import_file" accept=".xls, .csv, .xlsx">
        <input type="submit" name="save_excel_data" value="Upload and Process" class="btn-download">
    </form>

    <!-- Button Container for Download and Delete All Records -->
    <div class="button-container">
        <form action="Download.php" method="post" style="display:inline;">
            <input type="submit" value="Download Data" class="btn-download">
        </form>

        <form action="" method="post" style="display:inline;">
            <input type="hidden" name="delete_all" value="1">
            <input type="submit" value="Delete All Records" class="btn-delete-all">
        </form>
    </div>

    <!-- Display Table -->
    <h2>Students List</h2>
    <table>
        <thead>
            <tr>
                <th>S.N</th>
                <th>Name</th>
                <th>Height (cm)</th>
                <th>Weight (kg)</th>
                <th>Grade</th>
                <th>Section</th>
                <th>DOB (B.S)</th>
                <th>Age</th>
                <th>BMI</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM students";
            $result = mysqli_query($con, $query);
            $serialNumber = 1;

            while ($row = mysqli_fetch_assoc($result)) {
                $height = $row['height_cm'];
                $weight = $row['weight_kg'];
                $bmi = ($weight / ($height * $height)) * 10000; // BMI calculation formula

                if ($bmi < 18.5) {
                    $remarks = 'Underweight';
                } elseif ($bmi >= 18.5 && $bmi < 24.9) {
                    $remarks = 'Normal weight';
                } elseif ($bmi >= 25 && $bmi < 29.9) {
                    $remarks = 'Overweight';
                } else {
                    $remarks = 'Obesity';
                }

                echo '<tr>';
                echo '<td>' . $serialNumber++ . '</td>';
                echo '<td>' . htmlspecialchars($row['student_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['height_cm']) . '</td>';
                echo '<td>' . htmlspecialchars($row['weight_kg']) . '</td>';
                echo '<td>' . htmlspecialchars($row['grade']) . '</td>';
                echo '<td>' . htmlspecialchars($row['section']) . '</td>';
                echo '<td>' . htmlspecialchars($row['dob_bs']) . '</td>';
                echo '<td>' . htmlspecialchars($row['age']) . '</td>';
                echo '<td>' . number_format($bmi, 1) . '</td>';
                echo '<td>' . htmlspecialchars($remarks) . '</td>';
                echo '<td><form action="" method="post" style="display:inline;">
                    <input type="hidden" name="student_id" value="' . htmlspecialchars($row['id']) . '">
                    <input type="submit" class="btn-delete" value="Delete">
                </form></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <script>
        // Automatic fade-out for the message
        document.addEventListener('DOMContentLoaded', function() {
            var messageDiv = document.getElementById('message');
            if (messageDiv) {
                messageDiv.style.display = 'block';
                setTimeout(function() {
                    messageDiv.classList.add('fade-out');
                }, 100); // Start fade-out after a short delay
            }
        });
    </script>
</body>
</html>
