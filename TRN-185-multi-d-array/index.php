<?php

require 'get_difference.php';

$a1 = array(
    'a1' => array('a_name' => array('aaa','zzz'), 'a_value' => 'aaaaa'),
    'b1' => array('b_name' => 'bbb', 'b_value' => 'bbbbbb'),
    'c1' => array('c_name' => 'ccc', 'c_value' => 'cccccc')
);
$a2 = array(
    'a1' => array('a_name' => array('aaa')),
);

echo "<h1>Array-1</h1>";
print '<pre>';
print_r($a1);
print '</pre>';

echo "<h1>Array-2</h1>";
print '<pre>';
print_r($a2);
print '</pre>';

$get = new Get_Difference($a1, $a2);
$result = $get->find_difference();

echo "<h1>Difference</h1>";
print '<pre>';
print_r($result);
print '</pre>';


?>
