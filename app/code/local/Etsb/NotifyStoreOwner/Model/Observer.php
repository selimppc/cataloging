<?php

/**
 * Class Etsb_NotifyStoreOwner_Model_Observer
 */
class Etsb_NotifyStoreOwner_Model_Observer
{
    /**
     * Magento passes a Varien_Event_Observer object as
     * the first parameter of dispatched events.
     */
    public function notifystoreowner(Varien_Event_Observer $observer){

        // Retrieve the product being updated from the event observer
        $product = $observer->getEvent()->getProduct();

        $productId = $observer->getProduct()->getId();
        $model = Mage::getModel('catalog/product');
        $_product = $model->load($productId);
        $quantity = (int)Mage::getModel('cataloginventory/stock_item')
            ->loadByProduct($_product)->getQty();

        // Write a new line to var/log/product-updates.log
        $name = $product->getName();
        $sku = $product->getSku();

        $body = "Hello Store Owner, <br>Quantity : {$quantity},<br>Product Name : {$name},<br>SKU : {$sku}";
        $mail = Mage::getModel('core/email');
        $mail->setToName('Naf Hossain');
        //$mail->setToEmail('naf4me@gmail.com');
        $mail->setToEmail('shajjadhossain81@gmail.com');
        $mail->setBody($body);
        $mail->setSubject("Updated Quantity Change for product : {$productId}");
        $mail->setFromEmail('info@edutechsolutionsbd.com');
        //$mail->replyTo('shajjad84@gmail.com','Notify to Store Owner');
        $mail->setFromName("Edu Tech");
        $mail->setType('html');// You can use 'html' or 'text'

        try {
            $mail->send();
            Mage::getSingleton('core/session')->addSuccess('Your request has been sent');
        }
        catch (Exception $e) {
            Mage::getSingleton('core/session')->addError('Unable to send.');
        }

        Mage::log(
            "Product Name : {$name} , SKU : {$sku} , updated Quantity is :: {$quantity}",
            null,
            'product-updates.log'
        );
    }
}