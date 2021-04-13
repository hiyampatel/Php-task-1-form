<?php

    if(isset($_GET['q']))
    {
        header('Location: page'.$_GET['q'] . '.php');
    }

?>



<!DOCTYPE html>
<html>
    <head>
        <title>Form 2</title>
    </head>
    <body>
        <?php

            require('User_Validation.php');
            require('upload.php');

            $output_img = "";
            $output = [];
            $message = '';

            if(isset($_POST['submit']))
            {

                $validation = new User_Validate($_POST);
                $output = $validation->validateForm();

                if(($output['first'] == 'Required') || ($output['last'] == 'Required'))
                {
                    $message = 'All fields Required';
                    $output_img = '';
                    $output['full'] = '';
                    $output['out'] = '';
                }
                else
                {
                    $file = new File_Upload($_FILES['file']);
                    $output_img = $file->display();

                    if ($output_img == '')
                    {
                        $output_img = '';
                        $output['full'] = '';
                        $output['out'] = '';
                        $message = 'File not uploaded';
                    }
                    else if($output_img == "False")
                    {
                        $output_img = '';
                        $output['full'] = '';
                        $output['out'] = '';
                        $message = 'Not an Image file';
                    }

                }
            }
        ?>


        <h1>Form 2</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">

            First : <input type="text" name="first"><span><?php echo $output['first'] ?></span><br><br>

            Last : <input type="text" name="last"><span><?php echo $output['last']?></span><br><br>

            Full Name : <input type="type" id="full" name="full" value="<?php echo $output['full'] ?>" readonly><br><br>

            <input type="file" name="file"><br><br>

            <input type="submit" name="submit" value="Submit">
        </form>

        <h2><?php echo $output['out']?></h2>

        <img src="<?php echo 'Images/' . $output_img;?>"><br>

        <p><?php echo $message; ?></p>
    <body>
</html>







<?php

    for($i = 1; $i < 7; $i++)
    {
        echo '<a href="page'. $i.'.php">'.$i.'</a> ';
    }

?>
