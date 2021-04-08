
<!DOCTYPE html>
<html>
    <head>
        <title>Form</title>
    </head>
    <body>
        <?php
            $first = $last = "";
            $count = 0;
            $error1 = $error2 = "";

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                if(empty($_POST["first"]))
                {
                    $error1 = "Required";
                }
                else
                {
                    $first = validate_str($_POST['first']);
                    if (!preg_match("/^[a-zA-Z- ]*$/", $first))
                    {
                        $error1 = "Characters Only";
                    }
                    else{
                        $count += 1;
                    }
                }

                if(empty($_POST["last"]))
                {
                    $error2 = "Required";
                }
                else
                {
                    $last = validate_str($_POST['last']);
                    if (!preg_match("/^[a-zA-Z- ]*$/", $last))
                    {
                        $error2 = "Characters Only";
                    }
                    else{
                        $count += 1;
                    }
                }

                if ($count == 2){
                    $val = $first . " " . $last;
                }
            }


            function validate_str($string){
                $string = trim($string);
                $string = stripslashes($string);
                $string = htmlspecialchars($string);
                return $string;
            }
        ?>


        <h1>Basic Form</h1>
        <form method="POST" action="form.php">
            First : <input type="text" name="first"><span><?php echo $error1;?></span><br><br>
            Last : <input type="text" name="last"><span><?php echo $error2;?></span><br><br>
            Full Name : <input type="type" id="full" name="full" value="<?php echo $first." ".$last?>" readonly><br><br>
            <input type="submit" name="submit" value="Submit">
        </form>

        <h2><?php echo $val?></h2>
    <body>
</html>
