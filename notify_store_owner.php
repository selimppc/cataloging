<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//ini_set('soap.wsdl_cache_enabled', '0');
//ini_set('soap.wsdl_cache_ttl', '0');


$mageFilename = 'app/Mage.php';
require_once $mageFilename;

$username = 'admin';
$password = 'etsb123';

//$api_url = "http://localhost/magento/index.php/api/v2_soap/?wsdl=1"; //For Version 2

/*Note :: In Live Server Url @ ....index.php  and Localhost Url @ ..../index.php   */

$api_url = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']). '/index.php'."/api/v2_soap/?wsdl=1"; //For Version 2

//Will not cache the WSDL
$client = new SoapClient($api_url,array('cache_wsdl' => WSDL_CACHE_NONE));

//retreive session id from login
try{
    $session = $client->login($username, $password);
}catch (Exception $e) {
    exit("Invalid :: API User Name or Password");
}


$productId = $_GET['prod_id'];
$productqty = $_GET['qty'];

try{
    $product_exist = $client->catalogInventoryStockItemList($session, array($productId));
}
catch(exception $e){
    //nothing to do
}

if($product_exist==null or  $product_exist==""){
    exit("product is not exist");
}

/*//$result = $client->catalogProductList($session, $websiteId);
$result = $client->catalogInventoryStockItemList($session, array($productId));
print_r($result['qty']);
exit;*/

//update Product Information (It also update Log) ::
$result = $client->catalogProductUpdate($session, $productId, array(
    'stock_data' => array('qty' => $productqty)
));

if($result){
    echo "Successfully Notify Store Owner";
}else{
    echo "Failed To Notify Store Owner";
}