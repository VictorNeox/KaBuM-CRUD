<?php


$token = $_GET['token'];

$part = explode(".",$token);
$header = $part[0];
$payload = $part[1];
$signature = $part[2];


$valid = hash_hmac('sha256',"$header.$payload",'KaBuMCRUD',true);
$valid = base64_encode($valid);
echo $signature . '</br>';
echo $valid . '</br>';

$payload = base64_decode($payload);
$payload = json_decode($payload);


echo $payload->access;

