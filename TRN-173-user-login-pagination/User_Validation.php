<?php

class User_Validate
{
    private $data,$list;
    private $output_val=['first'=>'', 'last'=>'', 'full'=>'', 'out'=>''];
    private $list_sub;


    private static $field = ['first', 'last'];

    public function __construct($post_data)
    {
        $this->data = $post_data;
    }

    public function validateForm()
    {
        foreach(self::$field as $value)
        {
            if(empty($this->data[$value]))
            {
                $this->$output_val[$value] = "Required";
            }
            else
            {
                $n = $this->validate_str($this->data[$value]);

                if (!preg_match("/^[a-zA-Z- ]*$/", $n))
                {
                    $this->$output_val[$value] = "Characters Only";
                }


            }
        }

        if (!($this->$output_val['first'] == 'Required') && !($this->$output_val['last'] == 'Required'))
        {
            $this->$output_val['full'] = $this->data['first'] . " " . $this->data['last'];
        }

        if (($this->$output_val['first'] == '') && ($this->$output_val['last'] == ''))
        {
            $this->$output_val['out'] = "Hello " . $this->data['first'] . " " . $this->data['last'];
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



    public function Marks()
    {
        $list = ($this->data['marks']);

        if (empty($list))
        {
            return '';
        }

        $list_sup = explode("\n", $list);

        foreach($list_sup as $subject)
        {
            $n = explode("|", $subject);
            $this->$list_sub[$n[0]] = $n[1];
        }
        return $this->$list_sub;
    }

}
?>
