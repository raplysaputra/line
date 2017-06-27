<?php
$access_token = 'EBS3nA6f0y6z8EISusYXtZoGexa16VIez9K7umad43E4Sjvv7rwT7VI7Nv4G1bXiJP4Zu/nIjHw/akTJf7xP+KcMmBwTWHyWFKCYlUWBAIZmd+nyEUqXi6cykhBaOFCEsxwMglEyHaD4QxlJlusOEAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>
