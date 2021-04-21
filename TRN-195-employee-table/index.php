<?php

require 'main.php';

$emp = new Employee_Detail();
$emp->create_conn();


if(isset($_POST['submit']))
{
    if(($_POST['id']=='') || ($_POST['code']==''))
    {
        $error = 'Employee Id and Employee Code are Required';
    }
    else
    {
        $new = $emp->main($_POST);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee</title>
</head>
<body>
    <h1>Employee Details</h1>
    <form action="index.php" method="post">
        Employee Id: <input type="text" name="id"><br><br>
        First Name: <input type="text" name="firstname"><br><br>
        Last Name: <input type="text" name="lastname"><br><br>
        Employee Code: <input type="text" name="code"><br><br>
        Employee Code Name: <input type="text" name="codename"><br><br>
        Domain: <input type="text" name="domain"><br><br>
        Salary: <input type="text" name="salary"><br><br>
        Percentile: <input type="text" name="percentile"><br><br>
        <input type="submit" name="submit"><br><br>
    </form>

    <?php echo $new;?>

    <b><?php echo $error;?></b>

</body>
</html>
