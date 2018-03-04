<?php

require_once('./vendor/autoload.php');
use Postmark\PostmarkClient;


$postData = $_POST;

if (!isset($postData['name'], $postData['phone-number'], $postData['email'])) {
    header('Location: contact.php?error');
    exit;
}

if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
    header('Location: contact.php?error');
    exit;
}

$client = new PostmarkClient("a25898cb-e63d-481b-9c8c-2380d6b51a4e");

$sendResult = $client->sendEmail(
    "info@rostoninvestment.com",
    "info@rostoninvestment.com",
    'New Contact Message From - ' . $postData['name'],
    "Name: {$postData['name']} <br>" .
    "Phone Number: {$postData['phone-number']} <br>" .
    "Email: {$postData['email']}<br>"
);


header('Location: contact.php?success');