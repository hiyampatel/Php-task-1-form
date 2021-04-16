<?php

require 'game.php';

$result = '';
$output = '';
$play = '';

if (isset($_POST['submit']))
{
    $game = new Game($_POST['choice']);
    $result = $game->play();
    $output = '<h2>Result</h2>Opponet-1(user) : '.$result['user']. "<br>Opponet-2(computer) : ". $result['computer']. "<br>";
    $play = 'Play again!';
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Game</title>
</head>
<body>
    <h1>Rock, Paper & Scissor</h1>
    <div><?php echo $play;?></div><br>
    <form method="POST" action="index.php">
        Choose your option :
        <select id="choice" name="choice">
            <option value="Rock">Rock</option>
            <option value="Paper">Paper</option>
            <option value="Scissor">Scissor</option>
        </select><br><br>
        <input type="submit" name="submit">
    </form><br>
    <div><?php echo $output;?></div>
    <h3><?php echo $result['result'];?></h3>
</body>
</html>
