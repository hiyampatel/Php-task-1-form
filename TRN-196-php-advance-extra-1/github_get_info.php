<?php


/*
Created a Database Google_Github with table Github_Login having Id, User_name as fields.
*/

class Git_Login
{

    private $data, $conn;

    //getting the data and storing it in data variable
    public function __construct($post_data)
    {
        $this->data = $post_data;
    }

    //main function for connecting to server
    public function main()
    {
        $this->create_conn();
    }


    // To create connection with database
    private function create_conn()
    {
        $servername = 'localhost';
        $username = 'root';
        $password = 'hiya1234';
        $db = 'Google_Github';

        $this->conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($this->conn->connect_error)
        {
            die("Connection failed: " . $this->conn->connect_error);
        }

    }

    //checking for the user is registered or not
    //If true then print welcome back message
    //Else insert the data into table and print thanks foor registering message
    public function github_data()
    {
        $sql = 'SELECT * FROM Github_Login WHERE Id="'.$this->data->id.'"';

        $tout = $this->conn->query($sql);

        if($tout->num_rows > 0)
        {
            $_SESSION['m'] = "<h1>Welcome Back ".$this->data->login."</h1>";
        }
        else
        {
            $sql = "INSERT INTO Github_Login(Id,User_name) VALUES(".$this->data->id.",'".$this->data->login."')";

            $out = $this->conn->query($sql);
            $_SESSION['m'] = "<h1>Thank you for signing up!<h1>";
        }
    }




    //Storeing the user info into $_SESSION variable
    public function set_session_var()
    {
        if(!empty($this->data->login))
        {
            $_SESSION['user_name'] = $this->data->login;
        }

        if(!empty($this->data->Id))
        {
            $_SESSION['Id'] = $this->data->id;
        }

    }


}

?>
