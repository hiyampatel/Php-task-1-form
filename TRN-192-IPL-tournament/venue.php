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
    $sql = "INSERT INTO Venue() VALUES('".$_POST['venue']."')";
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
    <title>Venue</title>
</head>
<body>
    <h1>Venue Details</h1>
    <form action="venue.php" method="post">
        Venue : <input type="text" name="venue"><br><br>
        <input type="submit" name="submit"><br><br>
    </form>
    <?php echo $new;?>

</body>
</html>
