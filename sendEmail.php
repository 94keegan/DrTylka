<?php
ini_set("include_path", '/home1/drtylka/php:' . ini_get("include_path"));
require_once "Mail.php";
require_once "Mail/mime.php";

if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
    $name = strip_tags($_POST['name']);
    $email = strip_tags($_POST['email']);
    $message = strip_tags($_POST['message']);
    $to = "drtylka@drtylka.com";

    // Send from email details
    $from = "no-reply@drtylka.com";
    $host = "ssl://mail.drtylka.com";
    $username = "no-reply@drtylka.com";
    $password = "2jRrDdN@QU84";
    $port = "465";

    // Setting up email to send
    $subject = "Dr. Tylka || Contact";
    $headers = array('From' => $from, 'To' => $to, 'Subject' => $subject, 'Reply-To' => $to);
    $smtp = Mail::factory('smtp', array('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $body = '<!DOCTYPE html>
<html>
<body>
<p><strong>Name:</strong> ' . $name . '</p>
<p><strong>Contact Email:</strong> ' . $email . '</p>
<p><strong>Message:</strong> ' . $message . '</p>
</body>
</html>';

    $mime = new Mail_mime();
    $mime->setHTMLBody($body);
    $body = $mime->get();
    $headers = $mime->headers($headers);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = new stdClass(); // Initialize $response as an object
        $response->type = 'error';
        $response->text = 'Email is invalid!';
        $return = json_encode($response);
        die($return);
    } else {
        // Sending email
        $mail = $smtp->send($to, $headers, $body);

        // Check for errors when sending email
        $response = new stdClass(); // Initialize $response as an object
        if (PEAR::isError($mail)) {
            $response->type = 'error';
            $response->text = "Email failed to send! <p>" . $mail->getMessage() . "</p>";
        } else {
            $response->type = 'message';
            $response->text = 'Email has been sent!';
        }

        // Encode object as JSON and return
        $return = json_encode($response);
        die($return);
    }
} else if ((isset($_POST['name']) || isset($_POST['email']) || isset($_POST['message'])) && (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']))) {
    $response = new stdClass(); // Initialize $response as an object
    $response->type = 'error';
    $response->text = 'Please fill out all fields!';
    $return = json_encode($response);
    die($return);
}
?>
