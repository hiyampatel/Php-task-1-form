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
            $new = $this->code_table();
            $new = $new . "<br>".$this->salary_table();
            $new = $new . "<br>".$this->detail_table();
            return $new;

        }

        public function code_table()
        {
            $sql = "INSERT INTO employee_code_table(employee_code, employee_code_name, employee_domain) VALUES('".$this->data['code']."', '".$this->data['codename']."', '".$this->data['domain']."')";

            $new = $this->add_data($sql);
            $new = "<b>employee_code_table </b>" . $new;
            return $new;
        }

        public function salary_table()
        {
            $sql = "INSERT INTO employee_salary_table(employee_id, employee_salary, employee_code) VALUES('".$this->data['id']."', '".$this->data['salary']."', '".$this->data['code']."')";

            $new = $this->add_data($sql);
            $new = "<b>employee_salary_table </b>" . $new;
            return $new;
        }

        public function detail_table()
        {
            $sql = "INSERT INTO employee_details_table(employee_id, employee_first_name, employee_last_name, Graduation_percentile) VALUES('".$this->data['id']."', '".$this->data['firstname']."', '".$this->data['lastname']."', '".$this->data['percentile']."')";

            $new = $this->add_data($sql);
            $new = "<b>employee_details_table </b>" . $new;
            return $new;
        }

        public function add_data($sql)
        {

            $new = '';

            if ($this->conn->query($sql) === TRUE)
            {
                $new = "<b>Status: </b>New record created successfully";
            }
            else
            {
                $new = "<b>Status: </b>Error: " . $sql . "<br>" . $this->conn->error;
            }
            return $new;
        }


        public function fetch_data($sql)
        {
            $result = $this->conn->query($sql);

            return $result;
        }


    }

?>
