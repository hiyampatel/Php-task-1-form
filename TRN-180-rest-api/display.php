<?php

require 'vendor/autoload.php';

class Display_Data
{

    private $data;

    public function display()
    {
        $this->data = $this->get_data('https://www.innoraft.com/jsonapi/node/services');

        return $this->data;
    }

    private function get_data($url)
    {
        $client = new GuzzleHttp\Client();

        $response = $client->request('GET', $url);

        $json = $response->getBody()->getContents();

        $v = json_decode($json, true);

        return $v;
    }

}


?>
