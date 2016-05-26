<?php
class Etsb_Photography_Model_Mysql4_Photography_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        //$this->_init('photography/photography');
        $this->_init('editor/editor');
    }
}