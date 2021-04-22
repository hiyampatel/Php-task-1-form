<?php

require 'main.php';

$match = new IPL_Tournament();
$new = '';

if(isset($_POST['submit']))
{
    if(($_POST['team']=='')||($_POST['captain']==''))
    {
        $new = 'All fields are required.';
    }
    else
    {
        $match->create_conn();
        $sql = "INSERT INTO Teams(Team_name, Captain_name) VALUES('".$_POST['team']."', '".$_POST['captain']."')";
        $new = $match->add_data($sql);
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
