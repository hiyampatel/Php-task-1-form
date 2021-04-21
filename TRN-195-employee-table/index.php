<?php

require 'main.php';

$emp = new Employee_Detail();
$emp->start();


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

    <h3>Employee first name with salary greater than 50k.</h3>
    <table border="1" cellspacing="0">
        <tr>
            <td>employee_first_name</td>
            <td>employee_salary</td>
        </tr>
        <?php

            //select has parameters as array(tablename => array of fields to be displayed)
            $sql = $emp->select(array('employee_details_table'=>array('employee_first_name'), 'employee_salary_table'=>array('employee_salary')));

            //where has parameters as conditions
            $sql = $sql.$emp->where(array('employee_salary_table.employee_salary>"50k"'));

            $result = $emp->fetch_data($sql);

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo "<tr><td>".$row['employee_first_name']."</td><td>".$row['employee_salary']."</td></tr>";
                }
            }
        ?>
    </table>

    <h3>Employee last name with graduation percentile greater than 70%</h3>
    <table border="1" cellspacing="0">
        <tr>
            <td>employee_last_name</td>
            <td>Graduation_percentile</td>
        </tr>
        <?php
            //select has parameters as array(tablename => array of fields to be displayed)
            $sql = $emp->select(array('employee_details_table'=>array('employee_last_name','Graduation_percentile')));

            //where has parameters as conditions
            $sql = $sql.$emp->where(array('employee_details_table.Graduation_percentile>"70%"'));

            $result = $emp->fetch_data($sql);

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo "<tr><td>".$row['employee_last_name']."</td><td>".$row['Graduation_percentile']."</td></tr>";
                }
            }
        ?>
    </table>

    <h3>Employee code name with graduation percentile less than 70%</h3>
    <table border="1" cellspacing="0">
        <tr>
            <td>employee_code_name</td>
            <td>Graduation_percentile</td>
        </tr>
        <?php
            //select has parameters as array(tablename => array of fields to be displayed)
            $sql = $emp->select(array('employee_code_table'=>array('employee_code_name'),'employee_details_table'=>array('Graduation_percentile')));

            //where has parameters as conditions
            $sql = $sql.$emp->where(array('employee_details_table.Graduation_percentile<"70%"'));

            $result = $emp->fetch_data($sql);

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo "<tr><td>".$row['employee_code_name']."</td><td>".$row['Graduation_percentile']."</td></tr>";
                }
            }
        ?>
    </table>

    <h3>Employee’s full name that are not of domain Java</h3>
    <table border="1" cellspacing="0">
        <tr>
            <td>Full Name</td>
            <td>employee_domain</td>
        </tr>
        <?php
            //select has parameters as array(tablename => array of fields to be displayed)
            $sql = $emp->select(array('CONCAT(employee_details_table.employee_first_name," ",employee_details_table.employee_last_name) AS "Full Name"', 'employee_code_table'=>array('employee_domain')));

            //where has parameters as conditions
            $sql = $sql.$emp->where(array('employee_details_table.Graduation_percentile<"70%"'));

            $result = $emp->fetch_data($sql);

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo "<tr><td>".$row['Full Name']."</td><td>".$row['employee_domain']."</td></tr>";
                }
            }
        ?>
    </table>

    <h3>Employee_domain with sum of it's salary</h3>
    <table border="1" cellspacing="0">
        <tr>
            <td>employee_domain</td>
            <td>Sum of salary</td>
        </tr>
        <?php

            //select has parameters as array(tablename => array of fields to be displayed)
            $sql = $emp->select(array('employee_code_table'=>array('employee_domain'), 'SUM(employee_salary_table.employee_salary) AS "Total Sum"'));

            //where has parameters as conditions
            $sql = $sql.$emp->where();

            $sql = $sql.$emp->other_add(array('GROUP BY'=>'employee_code_table.employee_domain'));

            $result = $emp->fetch_data($sql);

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo "<tr><td>".$row['employee_domain']."</td><td>".$row['Total Sum']."</td></tr>";
                }
            }
        ?>
    </table>

    <h3>Employee_domain with sum of it's salary but salaries which is less than 30k are not included</h3>
    <table border="1" cellspacing="0">
        <tr>
            <td>employee_domain</td>
            <td>Sum of salary</td>
        </tr>
        <?php
            //select has parameters as array(tablename => array of fields to be displayed)
            $sql = $emp->select(array('employee_code_table'=>array('employee_domain'), 'SUM(employee_salary_table.employee_salary) AS "Total Sum"'));

            //where has parameters as conditions
            $sql = $sql.$emp->where(array('NOT employee_salary_table.employee_salary<"30k"'));

            $sql = $sql.$emp->other_add(array('GROUP BY'=>'employee_code_table.employee_domain'));

            $result = $emp->fetch_data($sql);

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo "<tr><td>".$row['employee_domain']."</td><td>".$row['Total Sum']."</td></tr>";
                }
            }
        ?>
    </table>

    <h3>Employee id which has not been assigned employee code name</h3>
    <table border="1" cellspacing="0">
        <tr>
            <td>employee_id</td>
        </tr>
        <?php

            $sql = "SELECT S.employee_id
                    FROM employee_code_table AS C, employee_salary_table AS S
                    WHERE  AND S.employee_code=C.employee_code;";

            //select has parameters as array(tablename => array of fields to be displayed)
            $sql = $emp->select(array('employee_salary_table'=>array('employee_id')));

            //where has parameters as conditions
            $sql = $sql.$emp->where(array('employee_code_table.employee_code_name=""'));

            $result = $emp->fetch_data($sql);

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo "<tr><td>".$row['employee_id']."</td></tr>";
                }
            }
        ?>
    </table>

</body>
</html>
