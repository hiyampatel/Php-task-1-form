<?php

require 'game.php';

$total = 0;
$result = '';
if (isset($_POST['submit']))
{
    $result = $_POST['choice'];
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Game</title>
</head>
<body>
    <h1>Rock, Paper & Scissor</h1>
    <form method="POST" action="index.php">
        Choose your option :
        <select id="choice" name="choice">
            <option value="rock">Rock</option>
            <option value="paper">Paper</option>
            <option value="scissor">Scissor</option>
        </select><br><br>
        <input type="submit" name="submit">
    </form>
    <h2><?php echo $result;?></h2>
</body>
</html>
