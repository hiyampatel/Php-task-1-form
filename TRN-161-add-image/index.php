<!DOCTYPE html>
<html>
<head>
    <title>Image_Upload</title>
</head>
<body>
    <?php

        $output = "";

        require('upload.php');

        if(isset($_POST["submit"]))
        {
            $file = new File_Upload($_FILES['file']);
            $output = $file->display();
        }

    ?>

    <h1>Uploading an Image</h1>
    <form method="POST" action="index.php" enctype="multipart/form-data">
        <input type="file" name="file"><br><br>
        <input type="submit" name="submit" value="Upload an Image">
    </form>
    <br>
    <img src="<?php echo 'Images/' . $output;?>" alt=""><br>
    <?php echo $output;?>
</body>
</html>
