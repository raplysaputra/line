<?php
$access_token = 'KKTDf1y+hn0XlTc/dwdnTGW3lM1iNlae4bgksk/7JLLBJo8rTZmPN5jmlCnfSQh4C9egi4Wq0pO5jx1OieL3Oph6NsrS2rnO3Frl/C5RHBP85LQmJLKAzf7fcvZoeMlufycfb5PSM0cbYpWLnWkG4wdB04t89/1O/w1cDnyilFU=';

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
