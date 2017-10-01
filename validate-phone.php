<?php

// my login in TCXC
$api_login ="ENTER BUYER USERNAME HERE";

//my API key
$api_key = "ENTER API KEY HERE";

// initialising CURL - Make sure you have php-curl module installed
$ch = curl_init();

//controller is a script name, so in case lookup.php controller is lookup
$controller = "whitelist";

//unix timestamp to ensure that signature will be valid temporary
$ts = time();

//compose signature concatenating controller api_key api_login and unix timestamp
$signature = hash( 'sha256', $controller .  $api_key   . $api_login  . $ts);

$params = array(
                'ts' => $ts,  //provide TS
                'signature' => $signature,
                'webapi'    => 1,
                'api_login' => $api_login,
                'number' => '380913100703', // same parameters as web portal accepts
                //...

                );


//query against api. URL
curl_setopt($ch, CURLOPT_URL,"https://members.telecomsxchange.com/$controller.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
http_build_query($params));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);

//analyze JSON output
echo "server_output:$server_output";


?>
