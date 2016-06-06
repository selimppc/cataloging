<?php
class Etsb_Archive_Block_Archive extends Mage_Core_Block_Template {

    public function getImageCollection() {
        $collection = Mage::getModel('archive/archive')->getCollection()
            ->addFieldToFilter('status',1);
        $banners = array();
        foreach ($collection as $banner) {
            $banners[] = $banner;
        }
        return $banners;
    }

} 