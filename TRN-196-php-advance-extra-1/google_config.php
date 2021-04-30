<?php

require 'vendor/autoload.php';

$google_client = new Google_Client();

$google_client->setClientId('420861686552-82hml4talrqbo8ikjojtg5239jrro1je.apps.googleusercontent.com');

$google_client->setClientSecret('O4Mb2StP1BXFj_5sAJGipSB8');

$google_client->setRedirectUri('http://localhost/Php-task-1-form/TRN-196-php-advance-extra-1/index.php');

$google_client->addScope('email');
$google_client->addScope('profile');

session_start();

?>
