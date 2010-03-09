APE_PHP
==============

Lightweight PHP Client Library to Connect to an APE (APE Ajax Push Engine) server

USAGE
------------------------

This example is meant to be used as a replacement for the PHP code
found in the APE_JSF Controller demo.

<?php

$APEhost = 'localhost';
$APEport = 6969;
$APEPassword = 'testpasswd';

$params =  array( 
   'password'  => $APEPassword, 
   'raw'       => 'postmsg', 
   'channel'   => 'testchannel', 
   'data'      => array( 
      'message' => 'Hello APE' 
   ) 
);

if(ApeFileConnection::available()){
   $conCls = 'ApeFileConnection';
}elseif(ApeCurlConnection::available()){
   $conCls = 'ApeCurlConnection';
}else{
   die('No valid Ape-Connection availabe');	
}

$connection = new $conCls($APEhost, $APEport);
$client = new ApeClient($connection);
$request = new ApeRequest('inlinepush', $params);
$response = $client->sendRequest($request);
$res = $response->getResult();
if ($res->data->value == 'ok') {
   echo 'Message sent !<pre>'.print_r($res, 1).'</pre>';}
else {
   echo 'Error sending message, server response is : <pre>'.print_r($res, 1).'</pre>';
}
?>

Other approach using ApeClient as a request gateway

<?php
$connection = new $conCls($APEhost, $APEport);
$client = new ApeClient($connection);
$response = $client->dispatchRequest('inlinepush', $params);
if ($response->getResult()->data->value == 'ok') {
   echo 'Message sent !<pre>'.print_r($response->getResult(), 1).'</pre>';}
else {
   echo 'Error sending message, server response is : <pre>'.print_r($response->getResult(), 1).'</pre>';
}
?>
