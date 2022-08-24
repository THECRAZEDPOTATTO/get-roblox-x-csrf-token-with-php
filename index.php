<?php
$url = "https://auth.roblox.com/v1/login";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_NOBODY, 0);
$headers = array(
   "Cookie: .ROBLOSECURITY=$cookie",
   "Content-Length: 0",
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
  $headers = substr($response, 0, $header_size);
  $body = substr($response, $header_size);
curl_close($ch);
header("Content-Type:text/plain; charset=UTF-8");
$lines = explode(PHP_EOL, $headers);
$remaining = array_filter($lines, function($line) {
     return strpos($line, 'x-csrf-token:') !== false;
});
$token1 = implode(PHP_EOL, $remaining);
$subject = $token1;
$search = 'x-csrf-token: ' ;
$token = str_replace($search, '', $subject) ;
echo $token;
