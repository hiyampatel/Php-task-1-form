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


    //main function
    public function validateForm()
    {

        $this->name_validation();
        $this->phone_validation();
        $this->email_check();

        return $this->output_val;
    }


    //string validation
    private function validate_str($string)
    {
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }


    //Setting value for table
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
            $this->list_sub[$n[0]] = $n[1];
        }
        return $this->list_sub;
    }


    //Validating first name and last name
    private function name_validation()
    {
        foreach(self::$field as $value)
        {
            if(empty($this->data[$value]))
            {
                $this->output_val[$value] = "Required";
            }
            else
            {
                $n = $this->validate_str($this->data[$value]);

                if (!preg_match("/^[a-zA-Z- ]*$/", $n))
                {
                    $this->output_val[$value] = "Characters Only";
                }


            }
        }

        if (!($this->output_val['first'] == 'Required') && !($this->output_val['last'] == 'Required'))
        {
            $this->output_val['full'] = $this->data['first'] . " " . $this->data['last'];
        }

        if (($this->output_val['first'] == '') && ($this->output_val['last'] == ''))
        {
            $this->output_val['out'] = "Hello " . $this->data['first'] . " " . $this->data['last'];
        }
    }


    //validating email
    private function phone_validation()
    {
        if(empty($this->data['phone']))
        {
            $this->output_val['phone'] = '';
            return ;
        }

        $p = $this->data['phone'];
        if(!preg_match('/^((?:\+)91(\s)?)\d{10}$/' ,$p))
        {
            $this->output_val['phone'] = 'False';
        }
        else
        {
            $this->output_val['phone'] = $this->data['phone'];
        }
    }


    //validating email
    private function email_check()
    {
        if (empty($this->data['email']))
        {
            $this->output_val['email'] = '';
            return ;
        }

        $email = $this->data['email'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);     //remove unwanted characters.

        if (filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $this->output_val['email_syn'] = 'Valid Syntax';
            $e = $this->email_validate();
            $this->output_val['email'] = $e;

        }
        else
        {
            $this->output_var['email_syn'] = 'Invalid Syntax';
            $this->output_var['email'] = 'False';
            return ;
        }


    }


    private function email_validate()
    {
        // set API Access Key
        $access_key = 'c04ea3282ac1e7b313328f517f79fa6d';

        // set email address
        $email_address = $this->data['email'];

        // Initialize CURL:
        $ch = curl_init('http://apilayer.net/api/check?access_key='.$access_key.'&email='.$email_address.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $validationResult = json_decode($json, true);

        if($validationResult['smtp_check'] != '1')
        {
            return 'False';
        }
        return 'True';

    }

}
?>
