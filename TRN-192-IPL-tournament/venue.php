<?php

require 'main.php';

$match = new IPL_Tournament();
$new = '';

if(isset($_POST['submit']))
{

    if($_POST['venue']=='')
    {
        $new = 'Field is required.';
    }
    else
    {
        $match->create_conn();
        $sql = "INSERT INTO Venue(Venue) VALUES('".$_POST['venue']."')";
        $new = $match->add_data($sql);
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
    <?php echo $new;?><br><br>
    <a href="index.php">Back</a>
</body>
</html>
