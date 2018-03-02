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

$client = new PostmarkClient("96218138-644d-43fa-8a7d-5321729e330d");

$sendResult = $client->sendEmail(
    "tolu@putsbox.com",
    "info@rostoninvestment.com",
    'New Contact Message From - ' . $postData['name'],
    "Name: {$postData['name']} <br>" .
    "Phone Number: {$postData['phone-number']} <br>" .
    "Email: {$postData['email']}<br>"
);


header('Location: contact.php?success');