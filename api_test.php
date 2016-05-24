<?php
$mageFilename = 'app/Mage.php';

require_once $mageFilename;
$helper = Mage::helper('Etsb/SkuInitiator');

echo $helper->getChildren($category_id);

exit;
ini_set('soap.wsdl_cache_enabled', '0');
ini_set('soap.wsdl_cache_ttl', '0');
error_reporting(E_ALL);
ini_set('display_errors', 1);
// custom api soap client example
$mageFilename = 'app/Mage.php';

require_once $mageFilename;



$url = Mage::getBaseUrl();
umask(0);
Mage::app();
$myhellomsg = "<b>Helloworld Mydons</b>";


try {
    $soap = new SoapClient($url.'api/?wsdl');
    print_r($soap);exit;
    /*$sessionId = $soap->login('apiUser', 'apiKey');
//echo "Login ID : $sessionId";
    $result = $soap->call($sessionId, 'customapi.hello',array($myhellomsg));*/
    echo $result;

}
catch(Exception $e) {
    echo $e->getMessage();
}


?>