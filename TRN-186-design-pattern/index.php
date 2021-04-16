<?php

class Design_Pattern
{



    //display Tables
    private $output = array();

    public function table()
    {
        echo "<h1>Printing Table</h1>";
        $this->display_table();
    }

    private function display_table()
    {
        echo "<table border='1' cellspacing='0'>";

        for($i=1;$i<=6;$i++)
        {
            echo "<tr>";
            for($j=1;$j<=5;$j++)
            {
                $mul = $i*$j;
                echo "<td height='30px'>".$i." * ".$j." = ".$mul."</td>";

            }
            echo "</tr>";
        }

        echo "</table>";

    }

}

$t = new Design_Pattern();
$t->table();

?>
