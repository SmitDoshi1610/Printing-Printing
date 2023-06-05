<?php
// Starting a session
session_start();

// Including the database connection file
include "conn.php";

// Checking if all the required fields are set
if (isset($_POST['file']) && isset($_POST['orin']) && isset($_POST['color']) && isset($_POST['side']) && isset($_POST['type'])) {
    // Checking if the user is logged in or not
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        // If not logged in, redirecting to the login page
        header('Location: index.php#modal');
        exit();
    } else {
        // Displaying a success message and logout and upload links
        echo "Yes, session started"; ?>
        <a href="logout.php">Logout</a>
        <a href="index.php#upload">upload</a>
<?php

        // Storing the form data in variables
        $file = $_POST['file'];
        $orin = $_POST['orin'];
        $color = $_POST['color'];
        $side = $_POST['side'];
        $type = $_POST['type'];
        $token = mt_rand(1000, 9999);
        $time = date('Y-m-d H:i:s');
        $firstname = $_SESSION['firstname'];
        $mobile = $_SESSION['mobile'];
        $email = $_SESSION['email'];
        $status = true;

        // Inserting the form data into the database
        // $pdf_name = $_FILES["file"]["name"];
        // $pdf_tmp_name = $_FILES["file"]["tmp_name"];
        // $pdf_size = $_FILES["file"]["size"];
        // $pdf_type = $_FILES["file"]["type"];
        // $pdf_data = file_get_contents($pdf_tmp_name);
        // $pdf_data = mysqli_real_escape_string($conn, $pdf_data);
        $sql2 = "INSERT INTO upload(file,orin,color,side,type,email,firstname,mobile,status,token,time) VALUES('$file','$orin','$color','$side','$type','$email','$firstname','$mobile','$status','$token','$time')";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2) {
            // If the data is successfully inserted, displaying a success message and exiting the script
            echo "success";
            exit();
        } else {
            // If there's an error inserting the data, redirecting to the index page with an error message and exiting the script
            header("Location: index.php?error=unknown error occurred");
            exit();
        }
    }
}

// if($_SERVER['REQUEST_METHOD'] == 'POST') {
// Check if the file was uploaded without errors
// if(isset($_FILES["file"]) && isset($_FILES["file"]["error"]) && $_FILES["file"]["error"] == 0) {
//     $file_type = mime_content_type($_FILES['file']['tmp_name']); // get the file type

//     if($file_type == "application/pdf") {
//         echo "The uploaded file is a PDF file of type: ".$file_type;
//     } else {
//         echo "The uploaded file is not a PDF file";
//     }
// } else {
//     echo "Error: No file was uploaded or an error occurred during upload";
// }
// }  

?>