<?php
if (!empty($_POST['email'])) {
    $email = strip_tags($_POST['email']);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = new stdClass(); // Initialize $response as an object
        $response->type = 'error';
        $response->text = 'Email is invalid!';
        $return = json_encode($response);
        die($return);
    } else {
        $target_dir = "Email List/";
        $my_file = 'EmailList.txt';
        // Create file directory if it doesn't exist
        if (!(is_dir($target_dir))) {
            mkdir($target_dir);
        }
        // Create file if it doesn't exist
        if (!is_file($target_dir . "/" . $my_file)) {
            $handle = fopen($target_dir . "/" . $my_file, 'a');
            fclose($handle);
        }
        // Read file
        $data = file_get_contents($target_dir . "/" . $my_file);
        // Determine if email already exists
        $emailList = explode(', ', $data);
        if (in_array($email, $emailList)) {
            $response = new stdClass(); // Initialize $response as an object
            $response->type = 'error';
            $response->text = 'Email is already in list!';
            $return = json_encode($response);
            die($return);
        } else {
            // Append email to file
            $handle = fopen($target_dir . "/" . $my_file, 'a');
            $data = $email . ", ";
            fwrite($handle, $data);
            fclose($handle);
            $response = new stdClass(); // Initialize $response as an object
            $response->type = 'message';
            $response->text = 'Email has been saved!';
            $return = json_encode($response);
            die($return);
        }
    }
} else if (isset($_POST['email']) && empty($_POST['email'])) {
    $response = new stdClass(); // Initialize $response as an object
    $response->type = 'error';
    $response->text = 'Please fill out all fields!';
    $return = json_encode($response);
    die($return);
}
?>