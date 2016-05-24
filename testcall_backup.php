<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//ini_set('soap.wsdl_cache_enabled', '0');
//ini_set('soap.wsdl_cache_ttl', '0');

$mageFilename = 'app/Mage.php';
require_once $mageFilename;

$username = 'admin';
$password = 'etsb123';

$api_url = "http://localhost/magento/index.php/api/v2_soap/?wsdl=1"; //For Version 2
//$api_url = "http://localhost/magento/index.php/api/soap/?wsdl";  //For Version 1


$client = new SoapClient($api_url,array('cache_wsdl' => WSDL_CACHE_NONE));  //Will cnot cache the WSDL
//print_r($client);exit;

//retreive session id from login
$session = $client->login($username, $password);
$websiteId='za';   //Product_id



//echo "<pre>";
//print_r($client->__getFunctions ());exit;

$resultActive = $client->productsapiActiveList($session,$websiteId); //Sample call in version 2

print_r($resultActive);exit;

$resultInacive = $client->productsapiInactiveList($session,$websiteId);  //Sample call in version 2

//echo "<pre>";print_r($resultActive);

//echo "<pre>";print_r($resultInacive);



