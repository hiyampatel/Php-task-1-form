<?php

require 'main.php';

$match = new IPL_Tournament();
$res = $match->main();
$ven = $res[0];
$team = $res[1];
$tour = $res[2];

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
        $new = $match->enter_match($_POST);
        $res = $match->fetch_data();
        $ven = $res[0];
        $team = $res[1];
        $tour = $res[2];
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

    <br>
    <h2>Teams and their Captain</h2>
    <table>
        <tr><td>ID</td>
            <td>Team Name</td>
            <td>Captain Name</td>
        </tr>
        <?php
            mysqli_data_seek($team,0);
            if ($team->num_rows > 0)
            {
                while($row = $team->fetch_assoc())
                {
                    echo "<tr><td>".$row['Id']."</td><td>".$row['Team_name']."</td><td>".$row['Captain_name']."</td></tr>";
                }
            }
        ?>
    </table>

    <br>
    <h2>Venue</h2>
    <table>
        <tr><td>ID</td>
            <td>Venue</td>
        </tr>
        <?php
            mysqli_data_seek($ven,0);
            if ($ven->num_rows > 0)
            {
                while($row = $ven->fetch_assoc())
                {
                    echo "<tr><td>".$row['Id']."</td><td>".$row['Venue']."</td></tr>";
                }
            }
        ?>
    </table>

    <br>
    <h2>Match Schedule</h2>
    <table>
        <tr><td>ID</td>
            <td>Date</td>
            <td>Venue </td>
            <td>Toss won</td>
            <td>Losing team</td>
            <td>Winning team</td>
        </tr>
        <?php

            $sql = $match->select(array('T.Id','T.Event_Date','V.Venue',array('M1.Team_name','Toss_won'),array('M2.Team_name','Losing_team'),array('M3.Team_name','Winning_team')), 'SELECT');

            $sql = $sql." ".$match->select(array(array('Tournament','T'),array('Venue','V'),array('Teams','M1'),array('Teams','M2'),array('Teams','M3')), 'FROM');

            $sql = $sql." ".$match->where(array('T.Venue_Id=V.Id','M1.Id=T.Toss_won','M2.Id=T.Losing_team','M3.Id=T.Winning_team'));

            $result = $match->query_data($sql);

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo "<tr><td>".$row['Id']."</td><td>".$row['Event_Date']."</td><td>".$row['Venue']."</td><td>".$row['Toss_won']."</td><td>".$row['Losing_team']."</td><td>".$row['Winning_team']."</td></tr>";
                }
            }
        ?>
    </table>





</body>
</html>
