<?php

include('google_config.php');

require 'google_login.php';

if(!isset($_SESSION['access_token']))
{
    $login_button = '<a href="'.$google_client->createAuthUrl().'">Login using Google</a>';
    echo "<button>".$login_button."</button><br>";

    $login_button = '<a href="https://github.com/login/oauth/authorize?client_id=8a2293e4aa17125e48f9">Login with Github</a>';
    echo "<button>".$login_button."</button>";
}
else
{
    echo $_SESSION['m'];
}


?>

