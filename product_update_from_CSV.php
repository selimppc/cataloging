<?php


//return $this->getUrl('*/*/edit', array('id' => $row->getId()));

set_time_limit(0);
ini_set('memory_limit', '1024M');
include_once "app/Mage.php";
include_once "downloader/Maged/Controller.php";

Mage::init();

$app = Mage::app('default');
    //echo 123;exit;

//echo $currentUrl = Mage::helper('core/url')->getCurrentUrl();exit;

//Mage::app()->getResponse()->setRedirect(Mage::helper('cateditor')->getUrl("*/*/edit", array('id'=>'1')));

//return Mage::helper('cateditor')->getUrl('*/*/edit', array('id' => 1));

//The category names should be exactly the same name from the csv file where the id is the corresponding category id in magento. This is done when the csv file doesn't contain ids for categories but the name of categories.
$categories = array(
    'Category 1' => 3,
    'Category 2' => 4,
    'Category 3' =>5,
    'Category 4'=>6,


);
$row = 0;
/*$datas = array(); // array_list
foreach($datas as $data){

}*/
if (($handle = fopen("product.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        //echo 'Importing product: '.$data[0].'<br />';exit;
        foreach($data as $d)
        {
            //echo $d.'<br />';
        }

        $num = count($data);

        //print_r($data[0]);exit;


        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;

        if($row == 1) continue;

        $product = Mage::getModel('catalog/product');

            $product->setSku($data[0]);
        $product->setName($data[9]);
        $product->setDescription($data[6]);
        $product->setShortDescription($data[12]);
        $product->setManufacturer($data[8]);
        $product->setPrice($data[11]);
        $product->setTypeId($data[4]);

        #$fullpath = 'media/catalog/product';
        $fullpath = $data[7];
        $ch = curl_init ($fullpath);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        $rawdata=curl_exec($ch);
        curl_close ($ch);


        #exit($fullpath);
        //$fullpath = $fullpath.$data[6];
        /*try {
            if (file_exists($fullpath)) {
                unlink($fullpath);
            }
            $fp = fopen($fullpath, 'x');
            fwrite($fp, $rawdata);
            fclose($fp);
            $product->addImageToMediaGallery($fullpath, 'image', true, false);
        }catch (Exception $ex){
            print_r($ex->getMessage());
        }*/

        $mediaArray = array(
            'thumbnail'   => $data[16],
            'small_image' => $data[13],
            'image'       => $data[7]
        );


        //print_r($mediaArray);exit;

        // Remove unset images, add image to gallery if exists
        $importDir = Mage::getBaseDir('media') . DS . 'import/';

        foreach ( $mediaArray as $imageType => $fileName ) {
            $filePath = $importDir . $fileName;

            if ( file_exists($filePath) ) {
                try {
                    $product->addImageToMediaGallery($filePath, $imageType, false);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                echo "Product does not have an image or the path is incorrect. Path was: {$filePath}<br/>";
            }
        }


        //$product->setMediaGallery (array('images'=>array (), 'values'=>array ())); //media gallery initialization
       // $product->addImageToMediaGallery('media/catalog/product/thumb/1/0/mail_queue2.png', array('thumbnail'), false, false); //assigning image, thumb and small image to media gallery

        //$fullpath = 'media/catalog/product/small/';
        /*$ch = curl_init ($data[15]);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        $rawdata=curl_exec($ch);
        curl_close ($ch);*/
        //$fullpath = $fullpath.$data[13].'.jpg';
        /*$fullpath = $fullpath.$data[7];
        if(file_exists($fullpath)) {
            unlink($fullpath);
        }*/
        /*$fp = fopen($fullpath,'x');
        fwrite($fp, $rawdata);
        fclose($fp);*/
        //$product->addImageToMediaGallery($fullpath, 'small-image', false);

        //$fullpath = 'media/catalog/product/high/';
        /*$ch = curl_init ($data[16]);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        $rawdata=curl_exec($ch);
        curl_close ($ch);*/
        //$fullpath = $fullpath.$data[13].'.jpg';
        /*$fullpath = $fullpath.$data[8];
        if(file_exists($fullpath)) {
            unlink($fullpath);
        }*/
        /*$fp = fopen($fullpath,'x');
        fwrite($fp, $rawdata);
        fclose($fp);*/
       // $product->addImageToMediaGallery($fullpath, 'image', false);



        $product->setAttributeSetId(4); // need to look this up
        //$product->setCategoryIds(array($categories[$data[11]])); // need to look these up
        $product->setCategoryIds(''); // need to look these up
        $product->setWeight($data[18]);
        $product->setTaxClassId($data[15]); // taxable goods
        $product->setVisibility($data[17]); // catalog, search
        $product->setStatus($data[14]); // enabled

        // assign product to the default website
        $product->setWebsiteIds(array(Mage::app()->getStore(true)->getWebsite()->getId()));


        /*$stockData = $product->getStockData();
        //$stockData['stock_id'] = 1; //Optional
        $stockData['qty'] = $data[9]; //18
        $stockData['is_in_stock'] = $data[10]=="In Stock"?1:0; //17
        $stockData['manage_stock'] = 1;
        $stockData['use_config_manage_stock'] = 1;
        $product->setStockData($stockData);*/

        //print_r($product);exit;


        $product->save();

        $stockItem = Mage::getModel('cataloginventory/stock_item');
        $stockItem->assignProduct($product);
        $stockItem->setData('is_in_stock', $data[2]);
        $stockItem->setData('manage_stock', 0);
        $stockItem->setData('stock_id', 1);
        $stockItem->setData('store_id', 1);
        $stockItem->setData('use_config_manage_stock', 1);
        $stockItem->setData('qty', $data[19]);
        $stockItem->save();

        //print_r($stockItem);exit;




    }
    fclose($handle);

    Mage::app()->getResponse()->setRedirect($_SERVER['HTTP_REFERER']);
    Mage::app()->getResponse()->sendResponse();
    exit;

}