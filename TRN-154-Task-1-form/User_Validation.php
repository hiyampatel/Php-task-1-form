<?php

class User_Validate
{
    private $name;
    private $output_val=['first'=>'', 'last'=>'', 'full'=>'', 'out'=>''];


    private static $field = ['first', 'last'];

    public function __construct($post_data)
    {
        $this->name = $post_data;
    }

    public function validateForm()
    {
        foreach(self::$field as $value)
        {
            if(empty($this->name[$value]))
            {
                $this->$output_val[$value] = "Required";
            }
            else
            {
                $n = $this->validate_str($this->name[$value]);

                if (!preg_match("/^[a-zA-Z- ]*$/", $n))
                {
                    $this->$output_val[$value] = "Characters Only";
                }


            }
        }

        if (!($this->$output_val['first'] == 'Required') && !($this->$output_val['last'] == 'Required'))
        {
            $this->$output_val['full'] = $this->name['first'] . " " . $this->name['last'];
        }

        if (($this->$output_val['first'] == '') && ($this->$output_val['last'] == ''))
        {
            $this->$output_val['out'] = "Hello " . $this->name['first'] . " " . $this->name['last'];
        }


        return $this->$output_val;
    }


    private function validate_str($string)
    {
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }

}
?>
