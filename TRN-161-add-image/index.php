

<!DOCTYPE html>
<html>
    <head>
        <title>Form</title>
    </head>
    <body>
        <?php

            require('User_Validation.php');
            require('upload.php');

            $output_img = "";
            $output = [];

            if(isset($_POST['submit']))
            {

                $validation = new User_Validate($_POST);
                $output = $validation->validateForm();

                $file = new File_Upload($_FILES['file']);
                $output_img = $file->display();
            }
        ?>


        <h1>Basic Form</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">

            First : <input type="text" name="first"><span><?php echo $output['first'] ?></span><br><br>

            Last : <input type="text" name="last"><span><?php echo $output['last']?></span><br><br>

            Full Name : <input type="type" id="full" name="full" value="<?php echo $output['full'] ?>" readonly><br><br>

            <input type="file" name="file"><br><br>

            <input type="submit" name="submit" value="Submit">
        </form>

        <h2><?php echo $output['out']?></h2>

        <img src="<?php echo 'Images/' . $output_img;?>" alt=""><br>
    <body>
</html>


