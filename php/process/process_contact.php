<?php
// ------------------------------------------------------
// PEEF Platform - Contact Form Processing Script (AJAX Version)
// ------------------------------------------------------
// This script handles the server-side logic for the
// contact form via an AJAX request. It validates, sanitizes,
// and simulates sending an email, then returns a JSON response.
// ------------------------------------------------------

// Set the content type header to JSON for all responses.
header('Content-Type: application/json');

// Include necessary core files.
require_once __DIR__ . '/../includes/functions.php';

// Initialize the response array.
$response = [
    'status' => 'error',
    'message' => 'An unexpected error occurred.'
];

// Check if the form was submitted via the POST method.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- 1. Form Data Collection & Sanitization ---
    $name = sanitize_input($_POST['name']);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = sanitize_input($_POST['subject']);
    $message = sanitize_input($_POST['message']);

    // --- 2. Validation ---
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $response['message'] = "Please fill in all fields.";
        echo json_encode($response);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "Invalid email format provided.";
        echo json_encode($response);
        exit;
    }

    // --- 3. Email Preparation & Sending ---
    $to = 'info@peef.ng'; // The recipient email address
    $headers = "From: " . $name . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $email_body = "You have received a new message from your website contact form.\n\n";
    $email_body .= "Here are the details:\n\n";
    $email_body .= "Name: " . $name . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Subject: " . $subject . "\n\n";
    $email_body .= "Message:\n" . $message . "\n";

    // ** Mail Sending Simulation **
    // In a live server environment, you would use the mail() function:
    //
    // if (mail($to, $subject, $email_body, $headers)) {
    //     $response['status'] = 'success';
    //     $response['message'] = "Your message has been sent successfully. We will get back to you shortly.";
    // } else {
    //     $response['message'] = "Sorry, there was an error sending your message. Please try again later.";
    // }
    //
    // For this demonstration, we will assume it's always successful.
    
    $response['status'] = 'success';
    $response['message'] = "Thank you for your message! We will get back to you shortly.";

} else {
    // If the page was accessed directly, return an error.
    http_response_code(405); // Method Not Allowed
    $response['message'] = 'Invalid request method.';
}

// Echo the JSON response and terminate the script.
echo json_encode($response);
exit;
?>
