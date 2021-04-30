<?php

require 'github_class.php';

//displaying the error message if token is not valid.
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
    die(error('Error: Invalid access token'));
}


$url = 'https://api.github.com/user';

$authHeader = "Authorization: token ".$access_token;
$userAgentHeader = "User-Agent: Demo";

// Getting the user info using Accesstoken
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', $authHeader, $userAgentHeader));

$json = curl_exec($ch);

$v = json_decode($json);

curl_close($ch);

//Displaying the data and storing the info into database
$login = new Git_Login($v);
$login->set_session_var();
$login->main();
$login->github_data();

echo $_SESSION['m'];


?>
