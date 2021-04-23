<?php

function error($msg)
{
    $response = [];
    $response['success'] = false;
    $response['message'] = $msg;
    return json_encode($response);
}

session_start();
$access_token = $_SESSION['my_access_token'];

if($access_token == '')
{
    die(error('Error: Invalid acess token'));
}


$url = 'https://api.github.com/user';

$authHeader = "Authorization: token ".$access_token;
$userAgentHeader = "User-Agent: Demo";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', $authHeader, $userAgentHeader));

$json = curl_exec($ch);

$v = json_decode($json);

curl_close($ch);

print_r($v);


?>
