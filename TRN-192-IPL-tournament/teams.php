<?php

$servername = 'localhost';
$username = 'root';
$password = 'hiya1234';
$db = 'IPL_tournament';

$new = '';


$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit']))
{
    $sql = "INSERT INTO Teams(Team_name, Captain_name) VALUES('".$_POST['team']."', '".$_POST['captain']."')";
    if ($conn->query($sql) === TRUE)
    {
        $new = "<b>Status: </b>New record created successfully";
    }
    else
    {
        $new = "<b>Status: </b>Error: " . $sql . "<br>" . $conn->error;
    }

}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Teams</title>
</head>
<body>
    <h1>Teams and Captain Details</h1>
    <form action="teams.php" method="post">
        Team : <input type="text" name="team"><br><br>
        Captain : <input type="text" name="captain"><br><br>
        <input type="submit" name="submit"><br><br>
    </form>
    <?php echo $new;?><br><br>
    <a href="index.php">Back</a>

</body>
</html>
