<?php
    $request = file_get_contents("php://input"); // gets the raw data
    $params = json_decode($request); // true for return as array
    $message = (string) $request;
    mail('spurty@gmail.com', 'Subject:params', $message );
?>
