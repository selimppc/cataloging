<?php
class Etsb_Photoeditor_Block_Photoeditor extends Mage_Core_Block_Template {

    public function getImageCollection() {
        $collection = Mage::getModel('photoeditor/photoeditor')->getCollection()
            ->addFieldToFilter('status',1);
        $banners = array();
        foreach ($collection as $banner) {
            $banners[] = $banner;
        }
        return $banners;
    }

} 