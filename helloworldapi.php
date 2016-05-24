<?php
// custom api soap client example
$mageFilename = 'app/Mage.php';

require_once $mageFilename;

$username = 'admin';
$password = 'etsb123';


$url = 'http://localhost/magento/index.php/';
//$url = Mage::getBaseUrl();
//print_r($url);exit;

umask(0);

//Mage::app();

$myhellomsg = "<b>Helloworld Mydons</b>";

try {
    $soap = new SoapClient($url.'api/?wsdl');
    //print_r($soap);exit;
    $sessionId = $soap->login($username, $password);
    //echo "Login ID : $sessionId";exit;
    //print_r($myhellomsg);exit;
    $result = $soap->call($sessionId, 'customapi.hello',array($myhellomsg));
    echo $result;

}
catch(Exception $e) {
    echo $e->getMessage();
}