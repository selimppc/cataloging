<?php

class Etsb_Photoeditor_Model_Mysql4_Photoeditor_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('editor/editor');
    }
}