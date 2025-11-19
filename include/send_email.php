<?php
// send_email.php - Modern replacement for cdform.cgi
// Handles form submissions from checkout and contact forms

// Include database functions
require_once __DIR__ . '/db.php';

// Configuration
$recipient_email = "phpcds@aretemm.net";
$from_email = "phpcds@aretemm.net";

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? 'phpCDs Form Submission';
$body = $_POST['body'] ?? '';
$form_type = $_POST['form_type'] ?? 'contact'; // 'contact' or 'checkout'

// Validation
$errors = [];

if (empty($name)) {
    $errors[] = "Name is required";
}

if (empty($email)) {
    $errors[] = "Email is required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
}

// If there are errors, redirect back with error message
if (!empty($errors)) {
    $error_msg = implode(", ", $errors);
    header("Location: ../error.php?msg=" . urlencode($error_msg));
    exit;
}

// Build email content
$email_body = "phpCDs Form Submission\n";
$email_body .= "======================\n\n";
$email_body .= "From: $name\n";
$email_body .= "Email: $email\n\n";

if ($form_type == 'checkout') {
    $email_body .= "CHECKOUT REQUEST\n";
    $email_body .= "================\n\n";
    
    // Get CD information from POST data
    if (isset($_POST['id']) && is_array($_POST['id'])) {
        $email_body .= "Requested CDs:\n\n";
        
        for ($i = 0; $i < count($_POST['id']); $i++) {
            $cd_id = $_POST['id'][$i] ?? '';
            $artist = $_POST['artist'][$i] ?? '';
            $album = $_POST['album'][$i] ?? '';
            
            $email_body .= "CD #" . ($i + 1) . ":\n";
            $email_body .= "  ID: $cd_id\n";
            $email_body .= "  Artist: $artist\n";
            $email_body .= "  Album: $album\n\n";
        }
    }
    
    $email_body .= "\nShipping Address:\n";
    $email_body .= "-----------------\n";
    $email_body .= $body . "\n";
    
} else {
    // Contact form
    $email_body .= "CONTACT FORM\n";
    $email_body .= "============\n\n";
    $email_body .= "Message:\n";
    $email_body .= $body . "\n";
}

// Email headers
$headers = "From: $from_email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Send email to recipient
$mail_sent = mail($recipient_email, $subject, $email_body, $headers);

// Send copy to sender
$sender_copy_sent = false;
if ($mail_sent) {
    $sender_subject = "Copy: " . $subject;
    $sender_body = "This is a copy of your submission to phpCDs:\n\n" . $email_body;
    $sender_headers = "From: $from_email\r\n";
    $sender_headers .= "X-Mailer: PHP/" . phpversion();
    $sender_copy_sent = mail($email, $sender_subject, $sender_body, $sender_headers);
}

if ($mail_sent) {
    // Success
    // Clear the cart if this was a checkout
    if ($form_type == 'checkout') {
        ClearCart();
        header("Location: ../checkout_success.php");
    } else {
        header("Location: ../contact_success.php");
    }
    exit;
} else {
    // Error sending email - log for debugging
    error_log("phpCDs email failed: " . print_r($_POST, true));
    header("Location: ../error.php?msg=" . urlencode("Failed to send email. Please try again."));
    exit;
}

function ClearCart()
{
    // Remove all items from the cart for the current user
    global $dbServer, $dbUser, $dbPass, $dbName;
    
    // Get a connection to the database
    $con = mysqli_connect($dbServer, $dbUser, $dbPass) or die("Unable to connect to database" . mysqli_errno($con));
    $database = mysqli_select_db($con, "$dbName") or die("Unable to select database $dbName" . mysqli_errno($con));
    
    $cartId = GetCartId();
    mysqli_query($con, "DELETE FROM cart WHERE cookieId = '$cartId'");
    mysqli_close($con);
}
?>
