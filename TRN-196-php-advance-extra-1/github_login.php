<?php

require 'github_get_info.php';


//storing the value of access token and going to user.php for displaying and getting data
class Get_Values
{
    private $client_id, $client_secret, $url, $data, $v;
    private $post_data = array();

    //get the code and store it in data
    public function __construct($get_data)
    {
        $this->data = $get_data;
    }

    //Stting the credential values
    private function credentials()
    {
        $this->client_id = '8a2293e4aa17125e48f9';
        $this->client_secret = '968e096d4e71264b6de9c72b4bc62343fe3d5f78';
        $this->url = 'https://github.com/login/oauth/access_token';
        $this->post_data = ['client_id'=>$this->client_id, 'client_secret'=>$this->client_secret, 'code'=>$this->data, 'scope'=>'user'];
        return ;
    }

    //returns the value of access token
    public function main()
    {
        $t = $this->get_accesstoken();

        return $t;
    }

    //use the code value to get access token using post method
    //return access token value
    private function get_accesstoken()
    {
        $this->credentials();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        $json = curl_exec($ch);
        $this->v = json_decode($json);
        curl_close($ch);

        return $this->v;
    }

    //get the user info using the access token
    //returns the user info
    public function get_user_info()
    {
        $user_url = 'https://api.github.com/user';
        $authHeader = "Authorization: token ".$this->v->access_token;
        $userAgentHeader = "User-Agent: Demo";

        // Getting the user info using Accesstoken
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $user_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', $authHeader, $userAgentHeader));
        $json = curl_exec($ch);
        $t = json_decode($json);
        curl_close($ch);

        return $t;
    }

}

$get = new Get_Values($_GET['code']);
$v = $get->main();


if($v->access_token != "")
{
    session_start();

    //getting the user info into variable n
    $n = $get->get_user_info();

    //Displaying the data and storing the info into database
    $login = new Git_Login($n);
    $login->set_session_var();
    $login->main();
    $login->github_data();

    //displaying the message
    echo $_SESSION['m'];
}





?>
