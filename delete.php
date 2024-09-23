<?php
session_start();
include('dbconfig.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['student_id'])) {
        $student_id = intval($_POST['student_id']);
        
        // Delete query
        $query = "DELETE FROM students WHERE id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $student_id);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = 'Record deleted successfully!';
        } else {
            $_SESSION['message'] = 'Error deleting record: ' . mysqli_error($con);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['message'] = 'No student ID provided!';
    }
    
    header('Location: index.php'); // Redirect back to the main page
    exit();
}
?>
