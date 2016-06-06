<?php
class Etsb_Photography_Block_Photography extends Mage_Core_Block_Template {

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