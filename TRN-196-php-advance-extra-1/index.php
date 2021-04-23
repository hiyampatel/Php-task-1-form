<?php

include('google_config.php');

require 'google_login.php';

if(!isset($_SESSION['access_token']))
{
    $login_button = '<a href="'.$google_client->createAuthUrl().'">Login using Google</a>';
    echo "<button>".$login_button."</button><br>";


}
else
{
    echo $_SESSION['m'];
}


?>

