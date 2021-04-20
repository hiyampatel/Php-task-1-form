

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

$sql1 = "SELECT * FROM Venue";
$ven = $conn->query($sql1);

$sql2 = "SELECT * FROM Teams";
$team = $conn->query($sql2);
$t = array();


if(isset($_POST['submit']))
{
    /*
    */
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Match</title>
</head>
<body>
    <h1>IPL Tornament Details</h1>
    <form action="index.php" method="post">
        Date(YYYY-MM-DD) : <input type="date" name="date"><br><br>
        Venue :
        <select name="venue">
            <?php

                if ($ven->num_rows > 0)
                {
                    while($row = $ven->fetch_assoc())
                    {
                        echo "<option value=".$row['Id'].">".$row['Venue']."</option>";
                    }
                }
            ?>
        </select><br><br>

        Team-1 :
        <select name="team1">
            <?php
                if ($team->num_rows > 0)
                {
                    while($row = $team->fetch_assoc())
                    {
                        echo "<option value=".$row['Id'].">".$row['Team_name']."</option>";
                    }
                }
            ?>
        </select><br><br>

        Team-2 :
        <select name="team2">
            <?php
                mysqli_data_seek($team,0);
                if ($team->num_rows > 0)
                {
                    while($row = $team->fetch_assoc())
                    {
                        echo "<option value=".$row['Id'].">".$row['Team_name']."</option>";
                    }
                }
            ?>
        </select><br><br>

        Toss Winning Team :
        <select name="toss">
            <?php
                mysqli_data_seek($team,0);
                if ($team->num_rows > 0)
                {
                    while($row = $team->fetch_assoc())
                    {
                        echo "<option value=".$row['Id'].">".$row['Team_name']."</option>";
                    }
                }
            ?>
        </select><br><br>

        Winning Team :
        <select name="winner">
            <?php
                mysqli_data_seek($team,0);
                if ($team->num_rows > 0)
                {
                    while($row = $team->fetch_assoc())
                    {
                        echo "<option value=".$row['Id'].">".$row['Team_name']."</option>";
                    }
                }
            ?>
        </select><br><br>

        <input type="submit" name="submit"><br><br>
    </form>

    For enering new data for venue and teams visit following links:<br>
    <a href="venue.php">Add new Venue</a><br>
    <a href="teams.php">Add new Team info</a><br><br>
    <?php echo $new;?>

</body>
</html>
