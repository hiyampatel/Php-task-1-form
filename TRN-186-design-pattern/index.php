<?php

class Design_Pattern
{

    //display Chessboard Pattern
    public function chessboard()
    {
        echo "<h1>Printing Chessboard Design</h1>";

        $this->display_chess();

    }

    private function display_chess()
    {

        echo "<table border='1' cellspacing='0'>";

        for($i=0;$i<8;$i++)
        {
            echo "<tr>";
            for($j=0;$j<8;$j++)
            {
                if(($i+$j)%2 == 0)
                {
                    echo "<td height='30px' width='30px' bgcolor=#000000></td>";
                }
                else
                {
                    echo "<td height='30px' width='30px' bgcolor=#ffffff></td>";
                }
            }
            echo "</tr>";
        }
    }


    //display Tables

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
$t->chessboard();

?>
