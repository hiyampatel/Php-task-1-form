<?php

    class Employee_Detail
    {
        private $data, $conn;

        public function create_conn()
        {
            $servername = 'localhost';
            $username = 'root';
            $password = 'hiya1234';
            $db = 'Employee';

            $this->conn = new mysqli($servername, $username, $password, $db);

            // Check connection
            if ($this->conn->connect_error)
            {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }

        public function main($post_data)
        {
            $this->data = $post_data;

        }

        public function code_table()
        {

        }

        public function salary_table()
        {

        }

        public function detail_table()
        {

        }


    }

?>
