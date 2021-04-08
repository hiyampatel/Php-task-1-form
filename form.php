
<!DOCTYPE html>
<html>
    <head>
        <title>Form</title>
    </head>
    <body>
        <?php
            $error1 = [];

            class user_validate
            {
                private $name,$val;
                public $error=[];


                private static $field = ['first', 'last'];

                public function __construct($post_data)
                {
                    $this->name = $post_data;
                }

                public function validateForm()
                {
                    foreach(self::$field as $value)
                    {
                        if(empty($this->name[$value]))
                        {
                            $this->$error[$value] = "Required";
                        }
                        else
                        {
                            $n = $this->validate_str($this->$name[$value]);

                            if (!preg_match("/^[a-zA-Z- ]*$/", $value))
                            {
                                $this->$error[$value] = "Characters Only";
                            }
                            else{
                                $this->$val = $this->$val.$value;
                            }
                        }
                    }


                }


                private function validate_str($string)
                {
                    $string = trim($string);
                    $string = stripslashes($string);
                    $string = htmlspecialchars($string);
                    return $string;
                }

            }

            if(isset($_POST['submit']))
            {

                $validation = new user_validate($_POST);
                $error1 = $validation->validateForm();
            }



        ?>


        <h1>Basic Form</h1>
        <form method="POST" action="form.php">
            First : <input type="text" name="first"><span><?php echo $error1['first'];?></span><br><br>
            Last : <input type="text" name="last"><span><?php echo $error1['last'];?></span><br><br>
            Full Name : <input type="type" id="full" name="full" value="" readonly><br><br>
            <input type="submit" name="submit" value="Submit">
        </form>

        <h2></h2>
    <body>
</html>
