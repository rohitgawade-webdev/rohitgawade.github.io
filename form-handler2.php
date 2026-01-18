<?php
/**
 * File Name: form-handler2.php
 * Save contact form data into Excel (CSV format)
 */

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Sanitize inputs
    $name    = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email   = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone   = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    

    // CSV file name
    $file = "form_data.csv";

    // If file does not exist, create it with headers
    if (!file_exists($file)) {
        $header = ["Name", "Email", "Phone", "Subject", "Message", "Date"];
        $fp = fopen($file, "w");
        fputcsv($fp, $header);
        fclose($fp);
    }

    // Append new row with data
    $fp = fopen($file, "a");
    fputcsv($fp, [$name, $email, $phone, $subject, $message, date("Y-m-d H:i:s")]);
    fclose($fp);

    // Success message
    echo "<h3 style='color:green;'>✅ Thank you, $name! Your message has been saved.</h3>";
} else {
    echo "<h3 style='color:red;'>❌ Invalid request</h3>";
}
?>
