<?php


$client_id = '8a2293e4aa17125e48f9';
$client_secret = '968e096d4e71264b6de9c72b4bc62343fe3d5f78';
$url = 'https://github.com/login/oauth/access_token';

$post_data = ['client_id'=>$client_id, 'client_secret'=>$client_secret, 'code'=>$_GET['code'], 'scope'=>'user'];

//getting the access token
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
$json = curl_exec($ch);
$v = json_decode($json);
curl_close($ch);

//storing the value of access token and going to user.php for displaying and getting data
if($v->access_token != "")
{
    session_start();
    $_SESSION['my_access_token'] = $v->access_token;

    header('Location: http://localhost/Php-task-1-form/TRN-196-php-advance-extra-1/user.php');
}
?>
