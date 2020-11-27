<?php

$basic  = new \Nexmo\Client\Credentials\Basic('aea1a96c', '1xdEyPuZJRocg0io');
$client = new \Nexmo\Client($basic);

$message = $client->message()->send([
    'to' => '263774914150',
    'from' => 'Vonage APIs',
    'text' => 'Hello from Vonage SMS API'
]);