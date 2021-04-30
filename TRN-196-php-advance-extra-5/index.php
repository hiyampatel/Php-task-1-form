<?php


require 'twitter_data.php';

$twitter = new Twitter_Api();
$statuses = $twitter->main();

?>


