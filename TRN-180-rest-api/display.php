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

    public function get_data($url)
    {
        $client = new GuzzleHttp\Client();

        $response = $client->request('GET', $url);

        $json = $response->getBody()->getContents();

        $v = json_decode($json, true);

        return $v;
    }


    public function get_img_url($url)
    {
        $img_add_1 = $this->get_data($url);
        $img_1 = 'https://www.innoraft.com' . $img_add_1['data']['attributes']['uri']['url'];

        return $img_1;
    }

    public function get_icon_urls($url)
    {
        $icon_list = [];
        $i = $this->get_data($url);
        foreach ($i['data'] as $key => $value) {

            $icon_1 = $value['relationships']['field_media_image']['links']['related']['href'];
            $icon = $this->get_img_url($icon_1);
            $icon_list[$key] = $icon;

        }

        return $icon_list;
    }

}


?>
