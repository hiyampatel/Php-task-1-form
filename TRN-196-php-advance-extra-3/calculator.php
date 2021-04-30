<?php

class Calculator
{

    private $a, $b, $op;

    //Stored the value of a, b and operand
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

//Storing the data of $_GET into variables.
$a = (int)$_GET['a'];
$b = (int)$_GET['b'];
$op = $_GET['op'];


//Creating object of class and performing the main function.
$cal = new Calculator($a, $op, $b);
$cal->main();



?>
