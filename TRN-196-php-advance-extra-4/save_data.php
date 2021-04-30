<?php

class Save_Data
{

    private $first, $last, $email, $conn;

    //Stored the value into first, last and email.
    public function __construct($f,$l,$e)
    {
        $this->first = $f;
        $this->last = $l;
        $this->email = $e;
    }

    //Create the connection with database
    //Check if the data is stored in database and perform task accordingly.
    public function main()
    {
        $this->create_conn();
        $this->check_data();

    }

    //Set connection with database.
    private function create_conn()
    {
        $servername = 'localhost';
        $username = 'root';
        $password = 'hiya1234';
        $db = 'Forms';

        $this->conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($this->conn->connect_error)
        {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return;
    }

    //Adding the new information into database
    private function store_data()
    {
        //query for adding new info
        $sql = 'INSERT INTO Form_Data(First_name,Last_name,Email) VALUES("'.$this->first.'","'.$this->last.'","'.$this->email.'")';

        if($this->conn->query($sql)===true)
        {
            echo "Record Added Sucessfully.";
        }
        else
        {
            echo "Error: ".$this->conn->error;
        }

    }

    //Check whether the table has the information send by form or not
    //If true then display message Data exist.
    //Else call the function store_data to store the data.
    private function check_data()
    {
        $sql = 'SELECT * FROM Form_Data WHERE Email="'.$this->email.'"';

        $res = $this->conn->query($sql);
        if($res->num_rows>0)
        {
            echo "Record with email id: ".$this->email." Already Exists.";
        }
        else
        {
            $this->store_data();
        }
    }


}

//Storing the data of $_GET into variables.
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$emaill = $_GET['email'];

//Creating object of class and performing the main function.
$save = new Save_Data($firstname, $lastname, $emaill);
$save->main();

?>
