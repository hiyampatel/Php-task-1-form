

<!DOCTYPE html>
<html>
    <head>
        <title>Form</title>
    </head>
    <body>
        <?php

            require('User_Validation.php');
            require('upload.php');
            require('save_file.php');


            $output_img = "";
            $output = [];
            $message = '';
            $p_message = '';
            $table = "";

            if(isset($_POST['submit']))
            {

                $validation = new User_Validate($_POST);
                $table = $validation->Marks();
                $output = $validation->validateForm();

                if(($output['first'] == 'Required') || ($output['last'] == 'Required') || ($table == '') || ($output['phone'] == '') || ($output['email'] == ''))
                {
                    $message = 'All fields Required';
                    $table = "";
                    $output['full'] = '';
                    $output['out'] = '';
                }
                else if($output['phone'] == 'False')
                {
                    $output_img = '';
                    $output['full'] = '';
                    $output['out'] = '';
                    $table = '';
                    $message = 'Not a valid Indian number';
                    $p_message = "<b>Number must start with +91 and must contain 10 digits</b>";
                    if($output['email'] == 'False')
                    {
                        $message = $message . "<br>Not a valid Email";
                    }

                }
                else if ($output['email'] == 'False')
                {
                    $output_img = '';
                    $output['full'] = '';
                    $output['out'] = '';
                    $table = '';
                    $message = 'Not a valid Email';
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
                    else
                    {
                        $save = new Save_File($_POST, $table, $output_img);
                        $save->save_info();
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

            Phone Number : <input type="text" name="phone"><br><span><?php echo $p_message; ?></span><br><br>

            Email : <input type="text" name="email"><br><b><span><?php echo $output['email_syn']; if($output['email'] == 'True'){echo '<br>Valid Email ID';}?></span></b><br><br>

            <input type="submit" name="submit" value="Submit">
        </form>

        <br><br>


        <h2><?php echo $output['out']?></h2>

        <img src="<?php echo 'Images/' . $output_img;?>"><br>

        <p><?php echo $message; ?></p><br><br>

        <?php

            if($table != '')
            {
                echo "<table border='1' cellspacing='0'>";

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


