<?php
class Etsb_Cateditor_Block_Cateditor extends Mage_Core_Block_Template {

    public function getImageCollection() {
        $collection = Mage::getModel('cateditor/cateditor')->getCollection()
            ->addFieldToFilter('status',1);
        $banners = array();
        foreach ($collection as $banner) {
            $banners[] = $banner;
        }
        return $banners;
    }

} 