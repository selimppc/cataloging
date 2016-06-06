
<?php
umask(0);
require 'app/Mage.php'; //include magento libraries
include_once "downloader/Maged/Controller.php";
Mage::init();
$app = Mage::app('default');

// Find the attribute set id
$sDefaultAttributeSetId = Mage::getSingleton('eav/config')
    ->getEntityType(Mage_Catalog_Model_Product::ENTITY)
    ->getDefaultAttributeSetId();

/** Array for simple products start here**/
$simpleProduct[0]['name'] = 'Polka Dots & Cherry black dress';
$simpleProduct[0]['sku'] = 'DR-058-S';
$simpleProduct[0]['weight'] = 250;
$simpleProduct[0]['attribute_set_id'] = $sDefaultAttributeSetId;   //ID of a attribute set named 'default'
$simpleProduct[0]['description'] = 'Polka Dots & Cherry black dress Description';
$simpleProduct[0]['short_description'] = 'Polka Dots & Cherry black dress Short Description';
$simpleProduct[0]['type_id'] = Mage_Catalog_Model_Product_Type::TYPE_SIMPLE;
$simpleProduct[0]['status'] = Mage_Catalog_Model_Product_Status::STATUS_ENABLED;
$simpleProduct[0]['visibility'] = Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE;
$simpleProduct[0]['tax_class_id'] = 0;
$simpleProduct[0]['price'] = 58.94;
$simpleProduct[0]['category_ids'] = array(4); // We are using hard code ID here
$simpleProduct[0]['size'] = 'S';
$simpleProduct[0]['stock_data'] = array(
    'manage_stock' => 1,
    'is_in_stock' => 1,
    'qty' => 10,
    'use_config_manage_stock' => 0
);

$simpleProduct[1]['name'] = 'Polka Dots & Cherry black dress';
$simpleProduct[1]['sku'] = 'DR-058_M';
$simpleProduct[1]['weight'] = 250;
$simpleProduct[1]['attribute_set_id'] = $sDefaultAttributeSetId;   //ID of a attribute set named 'default'
$simpleProduct[1]['description'] = 'Polka Dots & Cherry black dress Description';
$simpleProduct[1]['short_description'] = 'Polka Dots & Cherry black dress Short Description';
$simpleProduct[1]['type_id'] = Mage_Catalog_Model_Product_Type::TYPE_SIMPLE;
$simpleProduct[1]['status'] = Mage_Catalog_Model_Product_Status::STATUS_ENABLED;
$simpleProduct[1]['visibility'] = Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE;
$simpleProduct[1]['tax_class_id'] = 0;
$simpleProduct[1]['price'] = 58.94;
$simpleProduct[1]['category_ids'] = array(4);
$simpleProduct[1]['size'] = 'M';
$simpleProduct[1]['stock_data'] = array(
    'manage_stock' => 1,
    'is_in_stock' => 1,
    'qty' => 10,
    'use_config_manage_stock' => 0
);
/** Array for simple products End here**/

$simpleProducts = array();

foreach($simpleProduct as $product){ //insert all the simple product loop start
    $sProduct = Mage::getModel('catalog/product');
    $sProduct->setName($product['name']);
    $sProduct->setSku($product['sku']);
    $sProduct->setWeight($product['weight']);
    $sProduct->setAttributeSetId($product['attribute_set_id']);
    $sProduct->setDescription($product['description']);
    $sProduct->setShortDescription($product['short_description']);
    $sProduct->setTypeId($product['type_id'])->setWebsiteIds(array(1))->setStatus($product['status'])->setVisibility($product['visibility'])->setTaxClassId($product['tax_class_id']);
    $sProduct->setPrice($product['price']);
    $sProduct->setCategoryIds($product['category_ids']);
    $categoryIds = $product['category_ids'];
    $optionId = getOptionId('product_size',$product['size']);
    $sProduct->setData('product_size',$optionId);
    $sProduct->save();

    /// For Inventory Management
    $stockItem = Mage::getModel('cataloginventory/stock_item');
    $stockItem->assignProduct($sProduct);
    $stockItem->setData('is_in_stock', 1);
    $stockItem->setData('manage_stock', 1);
    $stockItem->setData('stock_id', 1);
    $stockItem->setData('store_id', 1);
    $stockItem->setData('use_config_manage_stock', 1);
    $stockItem->setData('qty', 100);
    $stockItem->save();



    // we are creating an array with some information which will be used to bind the simple products with the configurable
    array_push(
        $simpleProducts,
        array(
            "id" => $sProduct->getId(),
            "price" => $sProduct->getPrice(),
            "attr_code" => 'size',
            "attr_id" => 143, // I have used the hardcoded attribute id of attribute size, you must change according to your store
            "value" => $optionId,
            "label" => $product['size'],
        )
    );

    //print_r($simpleProducts);exit;
}	//insert all the simple product loop end

/// Configurable product start here
$cProduct = Mage::getModel('catalog/product');
$productData=array(
    'name' => 'Dress',
    'sku' => 'DR-058',
    'description' => 'Clear description about your Tshirt that explains its features',
    'short_description' => 'One liner',
    'weight' => 1,
    'status' => '1',
    'visibility' => '4', //4 = catalog & search.
    'attribute_set_id' => $sDefaultAttributeSetId,
    'type_id' => 'configurable',
    'price' => 1200,
    'tax_class_id' => 0,
    'page_layout' => 'one_column',
);

foreach($productData as $key => $value){
    $cProduct->setData($key,$value);
}
$cProduct->setWebsiteIds(array(1));
$cProduct->setCategoryIds($categoryIds);

$cProduct->setCanSaveConfigurableAttributes(true);
$cProduct->setCanSaveCustomOptions(true);

$cProduct->getTypeInstance()->setUsedProductAttributeIds(array(143)); //attribute ID of attribute 'size' in my store
$attributes_array = $cProduct->getTypeInstance()->getConfigurableAttributesAsArray();

foreach($attributes_array as $key => $attribute_array){
    $attributes_array[$key]['use_default'] = 1;
    $attributes_array[$key]['position'] = 0;

    if (isset($attribute_array['frontend_label'])){
        $attributes_array[$key]['label'] = $attribute_array['frontend_label'];
    }else {
        $attributes_array[$key]['label'] = $attribute_array['attribute_code'];
    }
}

// Add it back to the configurable product..
$cProduct->setConfigurableAttributesData($attributes_array);

$dataArray = array();
foreach ($simpleProducts as $simpleArray)
{
    $dataArray[$simpleArray['id']] = array();
    foreach ($attributes_array as $key => $attrArray)
    {
        array_push(
            $dataArray[$simpleArray['id']],
            array(
                "attribute_id" => $simpleArray['attr_id'],
                "label" => $simpleArray['label'],
                "is_percent" => 0,
                "pricing_value" => $simpleArray['price']
            )
        );
    }
}

/*$optionIdMat = getOptionId('product_material','100% Cotton');

//print_r($optionIdMat);exit;


$cProduct->setData('product_material',$optionIdMat);

$cProduct->setConfigurableProductsData($dataArray);*/

//Attach Image to Products
$mode = array("small_image","thumbnail","image");
$img1 = 'media/import/Shajjad.jpg';
$img2 = 'media/import/Shajjad.jpg';
$img3 = 'media/import/Shajjad.jpg';
$img4 = 'media/import/Shajjad.jpg';
$cProduct->addImageToMediaGallery($img1, $mode, false, false);
$cProduct->addImageToMediaGallery($img2, $mode, false, false);
$cProduct->addImageToMediaGallery($img3, $mode, false, false);
$cProduct->addImageToMediaGallery($img4, $mode, false, false);

$cProduct->save();

/// For Inventory Management
$stockItem = Mage::getModel('cataloginventory/stock_item');
$stockItem->assignProduct($cProduct);
$stockItem->setData('is_in_stock', 1);
$stockItem->setData('manage_stock', 1);
$stockItem->setData('stock_id', 1);
$stockItem->setData('store_id', 1);
$stockItem->setData('use_config_manage_stock', 1);
$stockItem->save();

//returns the option id for any attribute code by passing the label $attribute_code e.g. 'size','material','article'  $label e.g. 'S','M','100% Cotton'
function getOptionId($attribute_code,$label){


    $attribute_model = Mage::getModel('eav/entity_attribute');

    $attribute_options_model = Mage::getModel('eav/entity_attribute_source_table') ;
    $attribute_code = $attribute_model->getIdByCode('catalog_product', $attribute_code);
    $attribute = $attribute_model->load($attribute_code);

    $attribute_table = $attribute_options_model->setAttribute($attribute);
    $options = $attribute_options_model->getAllOptions(false);

    foreach($options as $option){
        if ($option['label'] == $label){
            $optionId=$option['value'];
            break;
        }
    }
    return $optionId;
}
?>