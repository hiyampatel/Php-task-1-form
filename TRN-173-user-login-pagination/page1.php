<?php

    if(isset($_GET['q']))
    {
        header('Location: page'.$_GET['q'] . '.php');
    }

?>



<!DOCTYPE html>
<html>
    <head>
        <title>Form 1</title>
    </head>
    <body>
        <?php

            require('User_Validation.php');
            $output = [];

            if(isset($_POST['submit']))
            {

                $validation = new User_Validate($_POST);
                $output = $validation->validateForm();
            }
        ?>


        <h1>Form 1</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">

            First : <input type="text" name="first"><span><?php echo $output['first'] ?></span><br><br>

            Last : <input type="text" name="last"><span><?php echo $output['last']?></span><br><br>

            Full Name : <input type="type" id="full" name="full" value="<?php echo $output['full'] ?>" readonly><br><br>

            <input type="submit" name="submit" value="Submit">
        </form>

        <h2><?php echo $output['out']?></h2>
    <body>
</html>



<?php

    for($i = 1; $i < 7; $i++)
    {
        echo '<a href="page'. $i.'.php">'.$i.'</a> ';
    }

?>
