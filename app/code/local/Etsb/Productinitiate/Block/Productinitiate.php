<?php
class Etsb_Productinitiate_Block_Productinitiate extends Mage_Core_Block_Template {

    public function getImageCollection() {
        $collection = Mage::getModel('editor/editor')->getCollection()
            ->addFieldToFilter('status',1);
        $banners = array();
        foreach ($collection as $banner) {
            $banners[] = $banner;
        }
        return $banners;
    }

} 