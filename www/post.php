<?php
    $request = file_get_contents("php://input");
    $params = json_decode($request);
    $subject=$params->Subject;
    $report=$params->Report;
    $message = (string) $request;
    mail('spurty@gmail.com', $subject, $report );
?>
