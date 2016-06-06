<?php

class Etsb_Archive_Model_Mysql4_Archive_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('editor/editor');
    }
}