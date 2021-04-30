<?php

require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;


class Twitter_Api
{

    private $api_key, $api_secret, $access_token, $access_token_secret;
    private $connect;

    private function credentials()
    {
        $this->api_key = 'X2E0hXlz6eohXekiH76YmgrHN';
        $this->api_secret = 'wDcemRgtxIJWXIK2DtsLk66toGUTrKJe4Mosdp8MdVDTQfZPJy';
        $this->access_token = '1313014393739771904-UZAwiZso3xHoA7vyjzPdmMQHHWu5O4';
        $this->access_token_secret = 'EuHkkvJtIR3EOaO3PWd7f6w7Cva1paROWDzOGscdOzKtQ';
    }

    public function main()
    {
        $this->connect = new TwitterOAuth($this->api_key, $this->api_secret, $this->access_token, $this->access_token_secret);
        $status = $this->connect->get("statuses/home_timeline", ['count'=>25, "exclude_replies"=>true]);

        return $status;

    }
}




?>
