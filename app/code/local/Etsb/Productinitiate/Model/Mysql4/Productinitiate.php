<?php
class Etsb_Productinitiate_Model_Mysql4_Productinitiate extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        //$this->_init('photography/photography', 'photography_id');
        $this->_init('editor/editor', 'editor_id');
    }
}