<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define recipient email address
$receiving_email_address = 'muzoufilmuhthaseem@gmail.com';

// Include the PHP Email Form class
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Error: Unable to load the "PHP Email Form" Library!');
}

// Initialize the email form
$contact = new PHP_Email_Form();
$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'] ?? '';
$contact->from_email = $_POST['email'] ?? '';
$contact->subject = $_POST['subject'] ?? 'No Subject';

// Add messages from the form inputs
$contact->add_message($contact->from_name, 'From');
$contact->add_message($contact->from_email, 'Email');
$contact->add_message($_POST['message'] ?? '', 'Message', 500);

// Send the email and provide feedback
if ($contact->send()) {
    echo "Your message has been sent. Thank you!";
} else {
    echo "Failed to send the message. Please try again.";
}
?>
