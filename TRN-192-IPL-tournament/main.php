<?php

    class IPL_Tournament
    {
        private $data, $conn;
        private $ven, $team, $tour;
        private $a=array();

        //To create connection and fetching all the table data
        public function main()
        {
            $this->create_conn();
            $b = $this->fetch_data();
            return $b;
        }


        // To create connection with database
        private function create_conn()
        {
            $servername = 'localhost';
            $username = 'root';
            $password = 'hiya1234';
            $db = 'IPL_tournament';

            $this->conn = new mysqli($servername, $username, $password, $db);

            // Check connection
            if ($this->conn->connect_error)
            {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }


        // getting table data by passing a query
        // returns the data in form of array of array
        public function fetch_data()
        {
            $sql1 = "SELECT * FROM Venue";
            $this->ven = $this->conn->query($sql1);

            $sql2 = "SELECT * FROM Teams";
            $this->team = $this->conn->query($sql2);

            $sql3 = "SELECT * FROM Tournament";
            $this->tour = $this->conn->query($sql3);

            array_push($this->a, $this->ven, $this->team, $this->tour);

            return $this->a;
        }


        //setting the query for entering the data into match table by using the information obtained from the form
        //returns query
        public function enter_match($post_data)
        {
            $this->data = $post_data;
            $this->data['venue'] = (int)$this->data['venue'];
            $this->data['toss'] = (int)$this->data['toss'];
            $lose = 0;
            $new = '';

            if($this->data['winner'] == $this->data['team1'])
            {
                $lose = (int)$this->data['team2'];
            }
            else
            {
                $lose = (int)$this->data['team1'];
            }
            $this->data['winner'] = (int)$this->data['winner'];

            $sql = "INSERT INTO Tournament(Event_Date, Venue_Id, Toss_won, Losing_team, Winning_team) VALUES('".$this->data['date']."', ".$this->data['venue'].", ".$this->data['toss'].", ".$lose.", ".$this->data['winner'].")";

            $new = $this->add_data($sql);

            return $new;
        }


        //takes query as input and add the data
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


        //setting any method such as select and from which can take 2 parameters
        //$select=the array of data to add to the $option command
        public function select($select, $option)
        {
            $out = $option.' ';

            foreach ($select as $key1 => $value1)
            {
                if(is_array($value1))
                {
                    $out = $out.$value1[0]." AS ".$value1[1].", ";
                }
                else
                {
                    $out = $out.$value1.", ";
                }
            }

            $out = rtrim($out, ", ");

            return $out;
        }

        //setting query for where command
        public function where($where=array())
        {
            $out = 'WHERE ';
            foreach ($where as $value)
            {
                $out = $out.$value." AND ";
            }

            $out = rtrim($out, " AND ");

            return $out;
        }

        //running the query.
        public function query_data($sql)
        {
            $result = $this->conn->query($sql);
            return $result;
        }
    }

?>
