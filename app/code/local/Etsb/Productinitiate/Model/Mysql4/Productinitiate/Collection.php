<?php
class Etsb_Productinitiate_Model_Mysql4_Productinitiate_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        //$this->_init('photography/photography');
        $this->_init('editor/editor');
    }
}