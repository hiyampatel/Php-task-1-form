<?php

class Calculator
{

    private $a, $b, $op;

    //stores the value of a, b and operand
    public function __construct($aa,$opp,$bb)
    {
        $this->a = $aa;
        $this->b = $bb;
        $this->op = $opp;
    }


    //calling function to calculate the result.
    public function main()
    {
        $this->calculate();
    }


    //calculate the result and display it.
    private function calculate()
    {
        if($this->op == 'mul')
        {
            echo ($this->a*$this->b);
        }
        else if($this->op == 'add')
        {
            echo ($this->a+$this->b);
        }
        else if($this->op == 'div')
        {
            echo ($this->a/$this->b);
        }
        else if($this->op == 'sub')
        {
            echo ($this->a-$this->b);
        }
        else if($this->op == 'no')
        {
            echo "Invalid Operator!";
        }
    }


}

$a = (int)$_GET['a'];
$b = (int)$_GET['b'];
$op = $_GET['op'];


$cal = new Calculator($a, $op, $b);
$cal->main();



?>
