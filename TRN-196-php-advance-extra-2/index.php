<?php

echo "<h2>Operating system PHP is running on</h2>";
echo php_uname()."<br>";
echo PHP_OS."<br>";

echo "<h2>PHP browser detection</h2>";
echo $_SERVER['HTTP_USER_AGENT'] . "<br><br><br>";

if (!empty($_SERVER['HTTPS']))
{
    echo 'Page is called from <b>https</b>';
}
else
{
    echo 'Page is called from <b>http</b>';
}

?>
