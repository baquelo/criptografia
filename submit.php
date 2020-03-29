<?php
$token = $_GET['token'];
$url = "https://api.codenation.dev/v1/challenge/dev-ps/submit-solution?token={$token}";

$ch = curl_init($url);

$cfile = new CURLFile('answer.json','application/json','answer');
$data = array('answer' => $cfile);

$headers = ["Content-Type:multipart/form-data"];
$realpath = realpath('answer.json');
$postfields = ['name' => 'answer', 'file' => '@' . $realpath];

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER , $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS , $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

echo curl_exec($ch);

curl_close($ch);
