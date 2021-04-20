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
$error = '';

if(isset($_POST['submit']))
{
    if(($_POST['date']=='') || ($_POST['venue']=='') || ($_POST['team1']=='') || ($_POST['team2']=='') || ($_POST['toss']=='') || ($_POST['winner']==''))
    {
        $error = 'All fields are Required';
    }
    elseif($_POST['team1'] == $_POST['team2'])
    {
        $error = 'Participating teams cannot be same.';
    }
    else
    {
        $_POST['venue'] = (int)$_POST['venue'];
        $_POST['toss'] = (int)$_POST['toss'];
        $lose = 0;

        if($_POST['winner'] == $_POST['team1'])
        {
            $lose = (int)$_POST['team1'];
        }
        else
        {
            $lose = (int)$_POST['team2'];
        }
        $_POST['winner'] = (int)$_POST['winner'];

        $sql = "INSERT INTO Tournament(Event_Date, Venue_Id, Toss_won, Losing_team, Winning_team) VALUES('".$_POST['date']."', ".$_POST['venue'].", ".$_POST['toss'].", ".$lose.", ".$_POST['winner'].")";
        if ($conn->query($sql) === TRUE)
        {
            $new = "<b>Status: </b>New record created successfully<br><br>";
        }
        else
        {
            $new = "<b>Status: </b>Error: " . $sql . "<br><br>" . $conn->error;
        }
    }
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
            <option value="" selected hidden></option>
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
            <option value='' selected hidden></option>
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
            <option value="" selected hidden></option>
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
            <option value="" selected hidden></option>
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
            <option value="" selected hidden></option>
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

    <b><?php echo $error;?></b>

</body>
</html>
