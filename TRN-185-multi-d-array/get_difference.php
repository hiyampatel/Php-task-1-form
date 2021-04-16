<?php


class Get_Difference
{

    private $a1, $a2;
    private $result=array();

    public function __construct($array1, $array2)
    {
        $this->a1 = $array1;
        $this->a2 = $array2;
    }

    public function find_difference()
    {
        $this->result = $this->difference($this->a1,$this->a2);

        return $this->result;
    }


    private function difference($array1, $array2)
    {
        $result = array();
        foreach($array1 as $key => $value)
        {
            if(isset($array2[$key]))
            {
                if(is_array($value) && $array2[$key])
                {
                    $result[$key] = $this->difference($value, $array2[$key]);
                }
            }
            else
            {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}


?>
