<?php


class Save_File
{

    private $data,$table,$img;


    public function __construct($post_data, $table_data, $img_name)
    {
        $this->data = $post_data;
        $this->table = $table_data;
        $this->img = $img_name;
    }

    public function save_info()
    {
        $s_data = $this->store_data();

        //saving file on server
        $open_file = fopen("Files/Form.doc","w+") or die("Unable to open file!");
        fwrite($open_file,$s_data);
        fclose($open_file);

        $this->file_download();


        return ;
    }


    //storing data in a value and returning it.
    private function store_data()
    {
        $first = "<h1>User Detail:-</h1> <br>First Name : " . $this->data['first'] . "<br>Last Name : " . $this->data['last'] . "<br>Full Name : " . $this->data['first'] . " " . $this->data['last'] . "<br>Phone Number : " . $this->data['phone'] . "<br>Email : " . $this->data['email'] . "<br><br>Marks (Subject - Marks): <br>";

        $first = $first . "<table border='1' cellspacing='0'>  <tr> <td><b>Subject</b></td> <td><b>Marks</b></td> <tr>";

        foreach($this->table as $sub=>$marks)
        {
            $first = $first . "<tr> <td>" . $sub . "</td><td>" . $marks . "</td> </tr><br>";
        }

        $first = $first . "</table>";

        $path = __DIR__ . "/Images/";

        $first = $first . "<br>Image : <br><img src='". $path . $this->img . "'>";

        return $first;
    }



    private function file_download()
    {
        $name = "Files/Form.doc";
        //header('Content-Description: File Transfer');
        header('Content-Type: application/msword');
        header("Content-Disposition: attachment; filename=\"Form.doc");
        readfile($name); //showing the path to the server where
        exit;
        return ;
    }
}


?>
