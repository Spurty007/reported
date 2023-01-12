<?php
    $request = file_get_contents("php://input");
    $params = json_decode($request);
    $actual_link = dirname('https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
    $subject=$params->Subject;
    $report=$params->Report . "\r\n\r\n\r\n\r\nSource: " . $actual_link;
    $headers = array(
        'From' => 'Score reporter <YOUREMAILADDRESSHERE>',
        'Reply-To' => 'YOUREMAILADDRESSHERE',
        'X-Mailer' => 'PHP/' . phpversion()
    );
    mail('YOUREMAILADDRESSHERE', $subject, $report, $headers );
?>
