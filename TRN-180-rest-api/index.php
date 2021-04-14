<?php


class Display_Data
{

    private $data;



    public function display()
    {
        $this->get_data();
    }

    private function get_data()
    {
        $ch = curl_init('https://www.innoraft.com/jsonapi/node/services');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);
        curl_close($ch);

        $v = json_decode($json, true);

        print_r($v);
        return ;

    }
}


$display = new Display_Data();
$output = $display->get_data();


?>
