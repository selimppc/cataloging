<?php

class Etsb_Cateditor_Model_Mysql4_Cateditor_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('editor/editor');
    }
}