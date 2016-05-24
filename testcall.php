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
$websiteId = 167;   //Product_id

//echo "<pre>";
//print_r($_productCollection);exit;

//$resultActive = $client->productsapiActiveList($session,$websiteId); //Sample call in version 2

//print_r($resultActive);exit;

//$resultInacive = $client->productsapiInactiveList($session,$websiteId);  //Sample call in version 2

//echo "<pre>";print_r($resultActive);

//echo "<pre>";print_r($resultInacive);
//$result = $client->catalogInventoryStockItemList($session, array($websiteId));
//print_r($result);

//update Only Product Quentity (It's not update Log) ::

/*$result = $client->catalogInventoryStockItemUpdate($session, $websiteId, array(
    'qty' => '185',
    'is_in_stock' => 1
));*/

//var_dump($result);


//update Product Information accept Quantity (It also update Log) ::

$result = $client->catalogProductUpdate($session, $websiteId, array(
    'categories' => array(2),
    'websites' => array(1),
    'name' => 'software : shajjad',
    'description' => 'Product description',
    'short_description' => 'Product short description',
    'weight' => '10',
    'status' => '1',
    'url_key' => 'product-url-key',
    'url_path' => 'product-url-path',
    'visibility' => '4',
    'price' => '100',
    'tax_class_id' => 1,
    'meta_title' => 'Product meta title',
    'meta_keyword' => 'Product meta keyword',
    'meta_description' => 'Product meta description',
    'stock_data' => array('qty' => 150)
));

//product[stock_data][original_inventory_qty] = 6 and product[stock_data][qty] = 7

/*$info = array(
    'qty' => 25,
    'is_in_stock' => 19,
    'categories' => array(2),
    'websites' => array(1),
    'name' => 'software',
    'description' => 'Product description',
    'short_description' => 'Product short description',
    'weight' => '10',
    'status' => '1',
    'url_key' => 'product-url-key',
    'url_path' => 'product-url-path',
    'visibility' => '4',
    'price' => 10,
    'tax_class_id' => 1,
    'meta_title' => 'Product meta title',
    'meta_keyword' => 'Product meta keyword',
    'meta_description' => 'Product meta description'
);


$productId = 137;

$result = $client->catalogInventoryStockItemUpdate($session, $productId, $info);

var_dump ($result);*/


/*----------------*/














