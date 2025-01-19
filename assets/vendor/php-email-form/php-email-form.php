<?php

class PHP_Email_Form {
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $ajax = false;
    public $smtp = null;
    private $messages = [];

    // Add a message with optional label and max length
    public function add_message($content, $label = '', $max_length = 0) {
        if ($max_length > 0 && strlen($content) > $max_length) {
            die("Error: $label exceeds maximum length of $max_length characters.");
        }
        $this->messages[] = "$label: $content";
    }

    // Send the email
    public function send() {
        if (empty($this->to)) {
            die('Error: No recipient email address specified.');
        }

        $email_message = implode("\n", $this->messages);
        $headers = "From: {$this->from_name} <{$this->from_email}>\r\n";
        $headers .= "Reply-To: {$this->from_email}\r\n";

        if ($this->smtp) {
            // Use SMTP if configured
            return $this->send_via_smtp($email_message, $headers);
        }

        // Use PHP's mail() function by default
        return mail($this->to, $this->subject, $email_message, $headers);
    }

    private function send_via_smtp($email_message, $headers) {
        if (!extension_loaded('openssl')) {
            die('Error: OpenSSL extension is required for SMTP.');
        }

        // Implement SMTP logic here (optional: use PHPMailer or similar libraries for complex setups)
        die('SMTP sending is not implemented in this basic version. Use PHPMailer for SMTP.');
    }
}
?>
