<?php

/*
Created a Database Google_Github with table Google_Login having Id, First_name, Last_name, Email as fields.
*/

class Login
{

    private $data, $conn;

    public function __construct($post_data)
    {
        $this->data = $post_data;
    }

    //main function to connect to database
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
    //store the message accordingly in Session['m']
    public function google_data()
    {
        $sql = 'SELECT * FROM Google_Login WHERE Email="'.$this->data['email'].'"';

        $tout = $this->conn->query($sql);

        if($tout->num_rows > 0)
        {
            $_SESSION['m'] = "<h1>Welcome Back ".$this->data['given_name']." ".$this->data['family_name']."</h1>";
        }
        else
        {
            $sql = "INSERT INTO Google_Login(First_name,Last_name,Email) VALUES('".$this->data['given_name']."','".$this->data['family_name']."','".$this->data['email']."')";

            $out = $this->conn->query($sql);
            $_SESSION['m'] = "<h1>Thank you for signing up!<h1>";
        }
    }




    //Storeing into $_SESSION variable
    public function set_session_var()
    {
        if(!empty($this->data['given_name']))
        {
            $_SESSION['user_first_name'] = $this->data['given_name'];
        }

        if(!empty($this->data['family_name']))
        {
            $_SESSION['user_last_name'] = $this->data['family_name'];
        }

        if(!empty($this->data['email']))
        {
            $_SESSION['user_email_address'] = $this->data['email'];
        }
    }


}





if(isset($_GET["code"]))
{
    //Exchange a code for an valid authentication token.
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    //To check for error
    if(!isset($token['error']))
    {
        //Set the access token used for requests
        $google_client->setAccessToken($token['access_token']);

        //Store "access_token" value in $_SESSION variable for future use.
        $_SESSION['access_token'] = $token['access_token'];

        //Create Object of Google Service OAuth 2 class
        $google_service = new Google_Service_Oauth2($google_client);

        //Getting user profile data from google
        $data = $google_service->userinfo->get();

        $login = new Login($data);
        $login->set_session_var();

        $login->main();
        $login->google_data();


    }
}

?>
