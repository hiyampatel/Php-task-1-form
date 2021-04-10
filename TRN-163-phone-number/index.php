

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
            $message = '';
            $table = "";

            if(isset($_POST['submit']))
            {

                $validation = new User_Validate($_POST);
                $table = $validation->Marks();
                $output = $validation->validateForm();

                if(($output['first'] == 'Required') || ($output['last'] == 'Required') || ($table == ''))
                {
                    $message = 'All fields Required';
                    $table = "";
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
                        $table = '';
                        $message = 'File not uploaded';
                    }
                    else if($output_img == "False")
                    {
                        $output_img = '';
                        $output['full'] = '';
                        $output['out'] = '';
                        $table = '';
                        $message = 'Not an Image file';
                    }

                }

            }
        ?>


        <h1>Basic Form</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">

            First : <input type="text" name="first"><span><?php echo $output['first'] ?></span><br><br>

            Last : <input type="text" name="last"><span><?php echo $output['last']?></span><br><br>

            Full Name : <input type="type" id="full" name="full" value="<?php echo $output['full'] ?>" readonly><br><br>

            <input type="file" name="file"><br><br>

            <textarea rows="15" cols="50" name="marks"></textarea><br><br>

            <input type="submit" name="submit" value="Submit">
        </form>

        <h2><?php echo $output['out']?></h2>

        <img src="<?php echo 'Images/' . $output_img;?>"><br>

        <p><?php echo $message; ?></p><br><br>

        <?php

            if($table != '')
            {
                echo "<table>";

                echo "<tr>";
                echo "<td><b>Subject</b></td>";
                echo "<td><b>Marks</b></td>";
                echo "<tr>";

                foreach ($table as $sub => $mark)
                {
                    echo "<tr>";
                    echo "<td>" . $sub . "</td>";
                    echo "<td>" . $mark . "</td>";
                    echo "<tr>";
                }

                echo "</table>";
            }

        ?>
    <body>
</html>


