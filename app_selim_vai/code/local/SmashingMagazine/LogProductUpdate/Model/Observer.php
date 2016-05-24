<?php
/**
 * Our class name should follow the directory structure of
 * our Observer.php model, starting from the namespace,
 * replacing directory separators with underscores.
 * i.e. app/code/local/SmashingMagazine/
 *                     LogProductUpdate/Model/Observer.php
 */
class SmashingMagazine_LogProductUpdate_Model_Observer
{
    /**
     * Magento passes a Varien_Event_Observer object as
     * the first parameter of dispatched events.
     */
    public function logUpdate(Varien_Event_Observer $observer)
    {
        // Retrieve the product being updated from the event observer
        $product = $observer->getEvent()->getProduct();
        $stockData = $observer->getEvent()->getProduct()->getStockData();

        // Write a new line to var/log/product-updates.log
        $name = $product->getName();
        $sku = $product->getSku();
        $qty = $stockData['qty'];
        $qty_old = $stockData['original_inventory_qty'];


        $body = "Hello Qty {$qty_old} changed to {$qty}";
        $mail = Mage::getModel('core/email');
        $mail->setToName('Selim Reza');
        $mail->setToEmail('selimppc@gmail.com');
        $mail->setBody($body);
        $mail->setSubject('Qty Change of {$name}');
        $mail->setFromEmail('selimppc@gmail.com');
        $mail->setFromName("{$sku}");
        $mail->setType('html');// You can use 'html' or 'text'

        try {
            $mail->send();
            Mage::getSingleton('core/session')->addSuccess('Your request has been sent');
            #$this->_redirect('');
        }
        catch (Exception $e) {
            Mage::getSingleton('core/session')->addError('Unable to send.');
            #$this->_redirect('');
        }

        Mage::log(
            "{$name} ({$sku}) updated:: {$qty} old is {$qty_old}",
            null,
            'product-updates.log'
        );
    }
}